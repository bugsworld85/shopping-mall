export default function ({ $axios }, inject) {
    // Create a custom axios instance
    const api = $axios.create();

    // Set baseURL to something different
    // api.setBaseURL("https://my_api.com");

    api.onError(({ response }) => {
        if (response) {
            console.log("ERROR: ", response);
        }
    });

    // Inject to context as $api
    inject("api", api);
}
