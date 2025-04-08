import { defineConfig, loadEnv } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd(), "");

    return {
        server: {
            hmr: {
                protocol: "wss",
                host: `${env.SUBDOMAIN}-5173.${env.NOTEBOOK_HOST}`,
                clientPort: 443,
            },
        },
        plugins: [
            laravel({
                input: ["resources/css/app.css", "resources/js/app.js"],
                refresh: [...refreshPaths, "app/Http/Livewire/**"],
            }),
        ],
    };
});
