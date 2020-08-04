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
                    <label>Sport Name:</label>
                    <input v-model="name" class="form-input mt-1 block w-full" placeholder="Sport Name">
                </div>

                <button
                    class="mt-8 bg-gray-500 p-2 font-bold text-gray-300 rounded"
                    :class="{'bg-green-500 text-white cursor-pointer' : canSendForm}"
                    :disabled="!(canSendForm)"
                    @click.prevent="sendRequest"
                >
                    {{ isUpdate ? "Update Sport" : "Create New Sport" }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import TheNavigation from "../components/TheNavigation";
    import GoBack from "../components/GoBack";

    export default {
        name: "AddSport",
        components: {TheNavigation, GoBack},
        props: ['isUpdate', 'propId', 'propName'],
        data() {
            return {
                name: this.propName,
            }
        }, computed: {
            canSendForm() {
                return (
                    this.name
                );
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
                const response = await axios.post('/api/sports', {
                    name: this.name,
                });

                if (response.status === 201) {
                    await this.$store.dispatch('fetchSportsData');
                    this.$router.push({name: 'sports'});
                }
            },
            async SendUpdateRequest() {
                const response = await axios.patch('/api/sports/' + this.propId, {
                    name: this.name,
                });

                if (response.status === 200) {
                    await this.$store.dispatch('fetchSportsData');
                    this.$router.push({name: 'sports'});
                }
            },
        }, mounted() {
            if (!this.$store.state.hasLoaded) {
                this.$store.dispatch('fetchTeamsData');
            }
        }
    }
</script>


