export default { // = methods
    fetchTeamsData({commit, dispatch}) {
        return new Promise((resolve, reject) => {
            axios.get("/api/teams")
                .then((response) => {
                    commit('SET_TEAMS', Object.assign(response.data.data));
                    dispatch('fetchSportsData');
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error)
                })
        })
    },
    fetchSportsData({commit}) {
        return new Promise((resolve, reject) => {
            axios.get("/api/sports")
                .then((response) => {
                    commit('SET_SPORTS', Object.assign(response.data.data));
                    commit('SET_HAS_LOADED');
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error)
                })
        })
    },

}
