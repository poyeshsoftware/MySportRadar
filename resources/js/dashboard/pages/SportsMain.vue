<template>
    <div class="container flex flex-col lg:flex-row">
        <div class="w-full lg:w-4/12">
            <the-navigation/>
        </div>
        <div class="w-full lg:w-8/12">
            <div class="ml-0 lg:ml-8 mt-8 lg:mt-0 ">


                <div class="flex justify-between mb-8 items-center">
                    <div></div>
                    <router-link class="bg-blue-400 rounded-lg p-2 text-white font-bold bg-blue-500"
                                 :to="{name: 'add_sport'}">Add Sport
                    </router-link>
                </div>
                <div v-for="(sport,index) in this.$store.state.sports" :key="index">
                    <ul>
                        <li class="mb-4 border border-gray-400 border-2 p-2 rounded-lg flex justify-between items-center">
                            <div class="flex flex-col w-full items-center">

                                <p class="px-4 w-full py-2 font-bold text-black">
                                    {{sport.name}}
                                </p>

                            </div>
                            <div class="flex">
                                <a class="block p-3 bg-blue-500 hover:bg-blue-400 rounded-lg mr-2 order-1 lg:order-3"
                                   @click.prevent="showDeleteModal(index)"
                                   title="delete">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                         class="fill-current text-white w-6 h-6">
                                        <path
                                            d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z"/>
                                    </svg>
                                </a>

                                <a class="block p-3 bg-blue-500 hover:bg-blue-400 rounded-lg mr-2 order-1 lg:order-3"
                                   @click.prevent="goForEdit(index)"
                                   title="edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                         class="fill-current text-white w-6 h-6">
                                        <path
                                            d="M6.3 12.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H7a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h6a1 1 0 0 1 0 2H4v14h14v-6z"/>
                                    </svg>

                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <delete-component v-if="showDelete"
                          :the-name="deleteDialogName"
                          :the-message="deleteDialoMessage"
                          @confirmDelete="handleDelete"
                          @cancelModal="cancelDeleteModal"/>

    </div>
</template>

<script>
    import TheNavigation from "../components/TheNavigation";
    import DeleteComponent from "../components/DeleteComponent";

    export default {
        name: "SportsMain",
        components: {TheNavigation, DeleteComponent},
        data() {
            return {
                deleteIndex: null,
                showDelete: false,
                deleteDialogName: "Sport",
                deleteDialoMessage: "All the events and teams related to this sport will be deleted !"
            }
        },
        methods: {
            showDeleteModal(index) {
                this.deleteIndex = index;
                this.showDelete = true;
            },
            async handleDelete() {
                let response = await axios.delete("/api/sports/" + this.$store.state.sports[this.deleteIndex].id);
                if (response.status === 200) {
                    await this.$store.dispatch('fetchTeamsData');
                    this.cancelDeleteModal();
                }
            },
            cancelDeleteModal() {
                this.showDelete = false;
                this.deleteIndex = null;
            },
            goForEdit(index) {
                const the_sport = this.$store.state.sports[index];
                this.$router.push({
                    name: 'edit_sport',
                    params: {
                        id: the_sport.id,
                        isUpdate: true,
                        propId: the_sport.id,
                        propName: the_sport.name
                    }
                })
            }
        },
        mounted() {
            if (!this.$store.state.hasLoaded) {
                this.$store.dispatch('fetchTeamsData');
            }
        }
    }
</script>
