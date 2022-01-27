export default {
    // Global page headers: https://go.nuxtjs.dev/config-head
    head: {
        title: "client",
        htmlAttrs: {
            lang: "en",
        },
        meta: [
            { charset: "utf-8" },
            {
                name: "viewport",
                content: "width=device-width, initial-scale=1",
            },
            { hid: "description", name: "description", content: "" },
            { name: "format-detection", content: "telephone=no" },
        ],
        link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }],
    },

    alias: {
        "@": "./",
        "@assets": "./assets",
        "@scss": "./assets/scss",
    },

    // Global CSS: https://go.nuxtjs.dev/config-css
    css: ["~/assets/scss/globals.scss", "~/assets/scss/main.scss"],

    // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
    plugins: ["~/plugins/api"],

    // Auto import components: https://go.nuxtjs.dev/config-components
    components: true,

    // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
    buildModules: [
        //
    ],

    // Modules: https://go.nuxtjs.dev/config-modules
    modules: [
        // https://go.nuxtjs.dev/bootstrap
        "bootstrap-vue/nuxt",
        // https://go.nuxtjs.dev/axios
        "@nuxtjs/axios",
        "@nuxtjs/auth-next",
        "@nuxtjs/moment",
    ],

    auth: {
        strategies: {
            laravelSanctum: {
                provider: "laravel/sanctum",
                url: "http://localhost:9000",
                endpoints: {
                    login: {
                        url: "/api/login",
                    },
                },
            },
        },
        redirect: {
            login: "/login",
            logout: "/",
            home: "/dashboard",
        },
    },

    // Axios module configuration: https://go.nuxtjs.dev/config-axios
    axios: {
        // proxy: true,
        // credentials: true,
        // proxy: {
        //     "/laravel": {
        //         target: "https://laravel-auth.nuxtjs.app",
        //         pathRewrite: { "^/laravel": "/" },
        //     },
        // },
        baseURL: "http://localhost:9000",
        headers: {
            Accept: "application/json",
        },
    },

    // Build Configuration: https://go.nuxtjs.dev/config-build
    build: {},

    server: {
        port: 8000, // default: 3000
    },

    router: {
        middleware: ["auth"],
    },
};
