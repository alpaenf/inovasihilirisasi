import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createInertiaApp({
    title: (title) => title ? `${title} | Inovasi Hilirisasi UNSOED` : 'Inovasi Hilirisasi UNSOED - Pusat Inovasi & Penerapan Teknologi',
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        // Directive for smooth entrance animation on scroll
        app.directive('reveal', {
            mounted(el, binding) {
                if (typeof window === 'undefined') return;

                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    el.classList.add('is-revealed');
                    return;
                }

                const options = typeof binding.value === 'object' && binding.value !== null
                    ? binding.value
                    : { delay: typeof binding.value === 'number' ? binding.value : 0 };

                const variant = options.variant || 'up';
                const delay = options.delay || 0;

                if (variant === 'scale') {
                    el.classList.add('reveal-scale');
                } else if (variant === 'left') {
                    el.classList.add('reveal-left');
                } else if (variant === 'right') {
                    el.classList.add('reveal-right');
                } else {
                    el.classList.add('reveal-on-scroll');
                }

                if (delay > 0) {
                    el.style.transitionDelay = `${delay}ms`;
                }

                const observer = new IntersectionObserver((entries, obs) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-revealed');
                            obs.unobserve(entry.target);
                        }
                    });
                }, {
                    rootMargin: '0px 0px -30px 0px',
                    threshold: 0.08,
                });

                el._revealObserver = observer;
                observer.observe(el);
            },
            unmounted(el) {
                if (el._revealObserver) {
                    el._revealObserver.disconnect();
                    delete el._revealObserver;
                }
            }
        });

        app.use(plugin).mount(el);
    },
    progress: {
        color: '#22C55E',
        showSpinner: true,
    },
});
