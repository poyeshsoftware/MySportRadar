
// = mutations - update data
export default {
    SET_EVENTS(state, events) {
        state.events = events
    },
    SET_SPORTS(state, sports) {
        state.sports = sports
    },
    SET_TEAMS(state, teams) {
        state.teams = teams
    },
    SET_HAS_LOADED(state) {
        state.hasLoaded = true
    }
}
