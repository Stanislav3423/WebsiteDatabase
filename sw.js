const staticCache = "s-cache-v9";
const dynamicCache = "d-cache-v9";
const asertUrls = [
    "js/script.js",
    "css/mystyles.css",
    "index.php",
    "Tasks.html",
    "Messages.html",
    "Dashboard.html",
    "validation.php"
];

self.addEventListener('install', async event => {
    const cache = await caches.open(staticCache)
    await cache.addAll(asertUrls)
})

self.addEventListener('activate', async event => {
    const cachNames = await caches.keys()
    await Promise.all(
        cachNames
            .filter(name => name !== staticCache)
            .filter(name => name !== dynamicCache)
            .map(name => caches.delete(name))
    )
})

self.addEventListener('fetch', event => {
    const {request} = event
    const url = new URL(request.url)
    if (url.origin === location.origin) {
        event.respondWith(cacheFirst(request))
    } else {
        event.respondWith(networkFirst(request))
    }
})

async function cacheFirst(request) {
    const cached = await caches.match(request)
    return cached ?? await fetch(request)
}

async function networkFirst(request) {
    const cache = await caches.open(dynamicCache)
    try {
        const response = await fetch(request)
        await cache.put(request, response.clone())
        return response
    } catch (e) {
        console.log('Error: '+e)
    }
}