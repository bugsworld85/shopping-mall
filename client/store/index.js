export const state = () => ({
    shops: [],
    users: [],
    roles: [],
    loginUser: null,
    currentShop: null,
    userShopReport: [],
});

export const getters = {
    loginUser: ({ loginUser }) => {
        return loginUser;
    },
    isSuperAdmin: ({ loginUser }) => {
        if (loginUser) {
            return loginUser.roles.some((role) => {
                return role.name === "super_admin";
            });
        }
        return false;
    },
    isStoreOwner: ({ loginUser }) => {
        if (loginUser) {
            return loginUser.roles.some((role) => {
                return role.name === "store_owner";
            });
        }
        return false;
    },
    loginUserShops: ({ loginUser }) => {
        console.log(loginUser);
        if (loginUser) {
            return loginUser.shops;
        }
        return [];
    },
    currentShop: ({ currentShop }) => {
        return currentShop;
    },
};

export const actions = {
    nuxtServerInit({ commit }, { req }) {
        //
    },
    async setLoginUser({ commit }, user) {
        commit("SET_LOGIN_USER", user);
    },
    async fetchShops({ commit }) {
        return await this.$api.get("/api/shops").then((response) => {
            commit("SET_SHOPS", response.data.data);
        });
    },
    async changeCurrentShop({ commit }, shop) {
        commit("SET_CURRENT_SHOP", shop);
    },
    async fetchRoles({ commit }) {
        return await this.$api.get("/api/roles").then((response) => {
            commit("SET_ROLES", response.data.data);
        });
    },
    async fetchUserShops({ commit }) {
        commit("SET_USER_SHOPS");
    },
    async fetchUserShopReport({ commit }, params) {
        await this.$api
            .get(`/api/user/shop/${shop_id}/visits`, {
                params,
            })
            .then((response) => {
                commit("SET_USER_SHOP_REPORT", response.data.data);
            });
    },
};

export const mutations = {
    SET_LOGIN_USER: (state, payload) => {
        state.loginUser = payload;
    },
    SET_SHOPS: (state, payload) => {
        state.shops = payload;
    },
    SET_CURRENT_SHOP: (state, payload) => {
        state.currentShop = payload;
    },
    SET_ROLES: (state, payload) => {
        state.roles = payload;
    },
    SET_USER_SHOPS: (state) => {
        if (state.loginUser) {
            state.shops = state.loginUser.shops;
        }
    },
    SET_USER_SHOP_REPORT: (state, payload) => {
        state.userShopReport = payload;
    },
};
