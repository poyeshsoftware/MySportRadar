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
                    <label>Team Name:</label>
                    <input v-model="name" class="form-input mt-1 block w-full" placeholder="Team Name">
                </div>

                <div class="flex flex-col mt-4 space-y-2">
                    <label>Sports this team has participated in:</label>
                    <!--                    <multiselect v-model="sports" :options="this.$store.getters.sportsNames"></multiselect>-->

                    <multiselect
                        v-model="sports"
                        :options="this.$store.state.sports"
                        :multiple="true"
                        :close-on-select="false"
                        :clear-on-select="false"
                        :preserve-search="true"
                        placeholder="Pick a sport"
                        label="name"
                        track-by="name"
                        :preselect-first="false">
                        <template slot="selection" slot-scope="{ values, search, isOpen }">
                            <span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} sports selected</span>
                        </template>
                    </multiselect>
                </div>

                <button
                    class="mt-8 bg-gray-500 p-2 font-bold text-gray-300 rounded"
                    :class="{'bg-green-500 text-white cursor-pointer' : canSendForm}"
                    :disabled="!(canSendForm)"
                    @click.prevent="sendRequest"
                >
                    {{ isUpdate ? "Update Team" : "Create New Team" }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import TheNavigation from "../components/TheNavigation";
    import GoBack from "../components/GoBack";
    import Multiselect from 'vue-multiselect'

    export default {
        name: "AddTeam",
        components: {TheNavigation, GoBack, Multiselect},
        props: ['isUpdate', 'propId', 'propName', 'propSports'],
        data() {
            return {
                name: this.propName,
                sports: this.propSports
            }
        }, computed: {
            canSendForm() {
                return (
                    this.name
                    &&
                    this.sports
                );
            }, sportIds() {
                return this.sports.map(sportItem => {
                    return sportItem.id
                });
            }
        }, methods: {
            sendRequest() {
                if (this.canSendForm) {
                    if (this.isUpdate) {
                        this.SendUpdateRequest()
                    } else {
                        this.SendCreateRequest()
                    }
                }
            },
            async SendCreateRequest() {
                const response = await axios.post('/api/teams', {
                    name: this.name,
                    sports: this.sportIds,
                });

                if (response.status === 201) {
                    await this.$store.dispatch('fetchTeamsData');
                    this.$router.push({name: 'teams'});
                }
            },
            async SendUpdateRequest() {
                const response = await axios.patch('/api/teams/' + this.propId, {
                    name: this.name,
                    sports: this.sportIds,
                });

                if (response.status === 200) {
                    await this.$store.dispatch('fetchTeamsData');
                    this.$router.push({name: 'teams'});
                }
            },
        }, mounted() {
            if (!this.$store.state.hasLoaded) {
                this.$store.dispatch('fetchTeamsData');
            }
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

