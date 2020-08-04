export default { // = computed properties
    sportsForFilteringNames(state) {
        var sports = state.sports.map(sportItem => {
            return sportItem.name
        });
        sports.unshift('All Sports');
        return sports;
    },
    sportsNames(state) {
        return state.sports.map(sportItem => {
            return sportItem.name
        });
    },
}
