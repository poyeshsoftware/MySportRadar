<template>
    <div class="container flex flex-col lg:flex-row">
        <div class="w-full lg:w-4/12">
            <the-navigation/>
        </div>
        <div class="w-full lg:w-8/12">
            <div class="my-6 lg:mt-0">
                <go-back/>
            </div>

            <div class="flex flex-col">

                <div class="flex flex-col mt-4 space-y-2">
                    <label>Select Event Date:</label>
                    <!--                    <VueTailwindPicker-->
                    <!--                        class=""-->
                    <!--                        @change="(v) => checkin = v"-->
                    <!--                    >-->
                    <!--                        <input type="text" v-model="checkin" />-->
                    <!--                    </VueTailwindPicker>-->

                    <flat-pickr
                        class="rounded border p-2"
                        :config="configs.dateTimePicker"
                        placeholder="Select date and Time of Event"
                        v-model="datetime">

                    </flat-pickr>
                </div>


                <div class="flex flex-col mt-6 space-y-2">
                    <label>Select Sport Category:</label>
                    <select v-model="sport" class="form-select mt-1 block border rounded w-full px-2 py-2">
                        <option disabled selected value="">Please select sport category</option>
                        <option v-for="item in this.$store.getters.sportsNames">
                            {{item}}
                        </option>
                    </select>
                    <!--                    <v-select-->
                    <!--                        v-model="sport"-->
                    <!--                        :items="this.$store.getters.sportsNames"-->
                    <!--                        label="Select Sport Category"-->
                    <!--                        :disabled="canChooseSport"-->
                    <!--                        dense-->
                    <!--                        solo-->
                    <!--                    ></v-select>-->

                </div>

                <div class="flex flex-col mt-6 space-y-2">
                    <label>Select Team 1:</label>
                    <select v-model="team1" class="form-select mt-1 block border rounded w-full px-2 py-2">
                        <option disabled selected value="">Please select team 1</option>
                        <option v-for="item in teamsNames">
                            {{item}}
                        </option>
                    </select>
                    <!--                    <v-select-->
                    <!--                        v-model="team1"-->
                    <!--                        :items="teamsNames"-->
                    <!--                        label="Select Team 1"-->
                    <!--                        :disabled="canChooseTeam1"-->
                    <!--                        dense-->
                    <!--                        solo-->
                    <!--                    ></v-select>-->
                </div>

                <div class="flex flex-col mt-6 space-y-2">
                    <label>Select Team 2:</label>
                    <select :disabled="canChooseTeam2" v-model="team2"
                            class="form-select mt-1 block border rounded w-full px-2 py-2">
                        <option disabled selected value="">Please select team 2</option>
                        <option v-for="item in teamsNames_2">
                            {{item}}
                        </option>
                    </select>
                    <!--                    <v-select-->
                    <!--                        v-model="team2"-->
                    <!--                        :items="teamsNames_2"-->
                    <!--                        label="Select Team 2"-->
                    <!--                        :disabled="canChooseTeam2"-->
                    <!--                        dense-->
                    <!--                        solo-->
                    <!--                    ></v-select>-->
                </div>

                <button
                    class="mt-8 bg-gray-500 p-2 font-bold text-gray-300 rounded"
                    :class="{'bg-green-500 text-white cursor-pointer' : !canSendForm}"
                    :disabled="canSendForm"
                    @click.prevent="sendRequest"
                >
                    {{ isUpdate ? "Update Event" : "Create Event" }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import TheNavigation from "../components/TheNavigation";
    import GoBack from "../components/GoBack";
    import flatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';
    import 'flatpickr/dist/themes/material_blue.css';

    export default {
        name: "AddEditEvent",
        components: {TheNavigation, GoBack, flatPickr},
        props: ['isUpdate', 'propId', 'propDate', 'propSport', 'propTeam1', 'propTeam2'],
        data() {
            return {
                datetime: this.propDate,
                sport: this.propSport,
                team1: this.propTeam1,
                team2: this.propTeam2,
                configs: {
                    dateTimePicker: {
                        enableTime: true,
                        dateFormat: 'Y-m-d H:i'
                    }
                }
            }
        }, computed: {
            teamsForSport: function () {
                if (this.sport) {
                    return this.$store.state.teams.filter(teamItem => {
                        var sports = teamItem.sports.filter(
                            sportItem => {
                                if (sportItem.name === this.sport) {
                                    console.log(teamItem.name);
                                    return sportItem
                                }
                            }
                        );
                        if (sports.length > 0) {
                            return teamItem;
                        }
                    });
                } else {
                    return [];
                }
            },
            teamsNames() {
                return this.teamsForSport.map(teamItem => {
                    return teamItem.name
                });
            },
            teamsNames_2() {
                var teams = this.teamsForSport.filter(teamItem => {
                    if (teamItem.name !== this.team1) {
                        return teamItem
                    }
                });

                return teams.map(teamsItem => {
                    return teamsItem.name
                });
            },
            canChooseSport() {
                return !(this.$store.state.sports.length > 0);
            },
            canChooseTeam1() {
                return !(
                    (this.$store.state.teams.length > 1) && this.sport
                );
            }, canChooseTeam2() {
                return !(
                    (this.$store.state.teams.length > 1) && this.sport && this.team1
                );
            }, canSendForm() {
                return !(
                    this.sport
                    &&
                    this.team1
                    &&
                    this.team2
                    &&
                    this.datetime
                );
            }
        }, watch: {
            team1: {
                deep: true,
                handler: async function () {
                    this.team2 = null;
                }
            },
            teamsForSport: {
                deep: true,
                handler: async function () {
                    this.team1 = null;
                }
            }
        }, methods: {
            sendRequest() {
                if (this.datetime && this.sport && this.team1 && this.team2) {
                    if (this.isUpdate) {
                        this.UpdateEvent()
                    } else {
                        this.CreateEvent()
                    }
                }
            },
            async CreateEvent() {
                const response = await axios.post('/api/events', {
                    date: this.datetime,
                    _sport_id: this.findSportByName(this.sport)[0].id,
                    _team_id_1: this.findTeamByName(this.team1)[0].id,
                    _team_id_2: this.findTeamByName(this.team2)[0].id,
                });

                if (response.status === 201) {
                    this.$router.push({name: 'dashboard'});
                }
            },
            async UpdateEvent() {
                const response = await axios.patch('/api/events/' + this.propId, {
                    date: this.datetime,
                    _sport_id: this.findSportByName(this.sport)[0].id,
                    _team_id_1: this.findTeamByName(this.team1)[0].id,
                    _team_id_2: this.findTeamByName(this.team2)[0].id,
                });

                if (response.status === 200) {
                    this.$router.push({name: 'dashboard'});
                }
            },
            findTeamByName(teamName) {
                return this.teamsForSport.filter(teamItem => {
                    if (teamItem.name === teamName) {
                        return teamItem
                    }
                })
            },
            findSportByName(sportName) {
                return this.$store.state.sports.filter(sportItem => {
                    if (sportItem.name === sportName) {
                        return sportItem
                    }
                })
            },
        }, mounted() {
            if (!this.$store.state.hasLoaded) {
                this.$store.dispatch('fetchTeamsData');
            }

        }
    }
</script>

<style scoped>


</style>
