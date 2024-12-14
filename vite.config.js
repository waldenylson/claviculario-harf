import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/custom.css",
                "resources/js/app.js",
            ],

            refresh: true, //[
            //     "resources/routes/**",
            //     "routes/**",
            //     "resources/views/**",
            //     "config/adminlte.php",
            // ],
        }),
    ],

    resolve: {
        alias: {
            "@js": "/resources/js",
            "@bootstrap": path.resolve(
                __dirname,
                "node_modules/bootstrap/dist",
            ),
            "@tmpdominus": path.resolve(
                __dirname,
                "node_modules/@eonasdan/tempus-dominus/dist",
            ),
            "@nm": path.resolve(__dirname, "node_modules/"),
            $: "jQuery",
        },
    },
});
