import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";
// import tailwindcss from "@tailwindcss/vite";
import ui from "@nuxt/ui/vite";
import { defineConfig } from "vite";

export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/js/app.ts"],
      refresh: true,
    }),
    //tailwindcss(),
    ui({
      inertia: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
  ],
});
