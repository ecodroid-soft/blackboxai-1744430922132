const CACHE_NAME = 'adinfra-cache-v1';
const urlsToCache = [
    '/',
    '/index.php',
    '/about.php',
    '/projects.php',
    '/contact.php',
    '/assets/css/custom.css',
    '/assets/js/main.js',
    'https://cdn.tailwindcss.com',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css',
    'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap',
    'https://unpkg.com/swiper/swiper-bundle.min.css',
    'https://unpkg.com/swiper/swiper-bundle.min.js',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'
];

// Install service worker and cache resources
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('Opened cache');
                return cache.addAll(urlsToCache);
            })
    );
});

// Fetch resources from cache or network
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                // Cache hit - return response
                if (response) {
                    return response;
                }

                // Clone the request because it's a stream and can only be consumed once
                const fetchRequest = event.request.clone();

                return fetch(fetchRequest).then(
                    response => {
                        // Check if we received a valid response
                        if (!response || response.status !== 200 || response.type !== 'basic') {
                            return response;
                        }

                        // Clone the response because it's a stream and can only be consumed once
                        const responseToCache = response.clone();

                        caches.open(CACHE_NAME)
                            .then(cache => {
                                // Don't cache PHP files
                                if (!event.request.url.endsWith('.php')) {
                                    cache.put(event.request, responseToCache);
                                }
                            });

                        return response;
                    }
                );
            })
    );
});

// Clean up old caches
self.addEventListener('activate', event => {
    const cacheWhitelist = [CACHE_NAME];

    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// Handle push notifications
self.addEventListener('push', event => {
    const options = {
        body: event.data.text(),
        icon: '/assets/images/icon-192x192.png',
        badge: '/assets/images/badge.png',
        vibrate: [100, 50, 100],
        data: {
            dateOfArrival: Date.now(),
            primaryKey: 1
        }
    };

    event.waitUntil(
        self.registration.showNotification('AD Infra', options)
    );
});

// Handle notification clicks
self.addEventListener('notificationclick', event => {
    event.notification.close();

    event.waitUntil(
        clients.openWindow('https://yourdomain.com')
    );
});

// Background sync for offline form submissions
self.addEventListener('sync', event => {
    if (event.tag === 'contact-form-sync') {
        event.waitUntil(
            // Implement form data sync when back online
            syncContactForm()
        );
    }
});

// Helper function to sync contact form data
async function syncContactForm() {
    try {
        const formDataRequests = await getContactFormData();
        await Promise.all(formDataRequests.map(request => fetch(request)));
        await clearContactFormData();
    } catch (error) {
        console.error('Error syncing contact form data:', error);
    }
}

// These functions would be implemented in the main application
function getContactFormData() {
    // Get stored form data from IndexedDB
    return Promise.resolve([]);
}

function clearContactFormData() {
    // Clear synchronized form data from IndexedDB
    return Promise.resolve();
}
