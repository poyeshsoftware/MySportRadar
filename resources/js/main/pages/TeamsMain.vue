<template>
    <div class="container flex flex-col lg:flex-row">
        <div class="w-full lg:w-4/12">
            <the-navigation/>
        </div>
        <div class="w-full lg:w-8/12">
            <div class="ml-0 lg:ml-8 mt-8 lg:mt-0 ">

                <div v-for="(team,index) in this.$store.state.teams" :key="index">
                    <ul>
                        <li class="mb-4 border border-gray-400 border-2 p-2 rounded-lg flex justify-between items-center">
                            <div class="flex flex-col w-full items-center">

                                <p class="px-4 w-full py-2 font-bold text-black">
                                    {{team.name}}
                                </p>
                                <ul class="px-4 w-full flex flex-col text-sm">
                                    <li v-for="sport in team.sports">
                                        {{sport.name}}
                                    </li>
                                </ul>
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
        name: "TeamsMain",
        components: {TheNavigation},
        data() {
            return {}
        },
        methods: {},
        mounted() {
            if (!this.$store.state.hasLoaded) {
                this.$store.dispatch('fetchTeamsData');
            }
        }
    }
</script>
