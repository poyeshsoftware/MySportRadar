<template>
    <div class="container flex flex-col lg:flex-row">
        <div class="w-full lg:w-4/12">
            <the-navigation/>
        </div>
        <div class="w-full lg:w-8/12">
            <div class="ml-0 lg:ml-8 mt-8 lg:mt-0 ">


                <div class="flex justify-between mb-8 items-center">

                    <div class="w-64 h-8 block">

                        <select v-model="defaultFilterSelected"
                                class="form-select mt-1 block border rounded w-full px-2 py-2">
                            <option v-for="item in this.$store.getters.sportsForFilteringNames">
                                {{item}}
                            </option>
                        </select>

                    </div>

                </div>
                <div v-for="(event,index) in events" :key="index">
                    <ul>
                        <li class="mb-4 border border-gray-400 border-2 p-2 rounded-lg flex justify-between items-center">
                            <div class="flex flex-col w-full items-center">

                                <p class="px-4 w-full py-2 font-bold text-black">
                                    {{event.sport.name}}
                                </p>
                                <p class="px-4 w-full pb-2 text-black">
                                    <span class="text-sm">{{event.team_1.name}}</span> vs <span class="text-sm">{{event.team_2.name}}</span>
                                    at <span class="text-sm">{{ event.date }}</span>
                                </p>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import TheNavigation from "../components/TheNavigation";

    export default {
        name: "DashboardMain",
        components: {TheNavigation},
        data() {
            return {
                defaultFilterSelected: 'All Sports',
                events: [],
                deleteIndex: null,
                showDelete: false,
            }
        },
        methods: {
            changeSportFilter(item) {
                this.SportFilter = item;
            },
            async getEvents() {
                var sportIdQuery = '';
                if (this.defaultFilterSelected !== "All Sports") {
                    let the_sport_id = this.findSportIdByName(this.defaultFilterSelected);
                    sportIdQuery = '?sport_id=' + the_sport_id;
                }

                let response = await axios.get("/api/events" + sportIdQuery);
                this.events = response.data.data
            },
            findSportIdByName(sportName) {
                let index = this.$store.state.sports.findIndex(x => x.name === sportName);
                return this.$store.state.sports[index].id;
            },
        },
        watch: {
            defaultFilterSelected: {
                handler: async function () {
                    if (this.$store.state.sports.length > 0) {
                        this.events = [];
                        this.getEvents();
                    }
                }
            }
        },
        created() {
            this.getEvents();
        },
        mounted() {
            if (!this.$store.state.hasLoaded) {
                this.$store.dispatch('fetchTeamsData');
            }
        }
    }
</script>


