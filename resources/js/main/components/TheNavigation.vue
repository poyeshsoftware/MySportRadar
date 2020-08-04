<template>
    <ul class="space-y-4 text-xl">
        <li>
            <router-link :to="{name: 'dashboard'}"><h2>- Manage Events</h2></router-link>
        </li>
        <li>
            <router-link :to="{name: 'sports',}"><h2>- Manage Sports</h2></router-link>
        </li>
        <li>
            <router-link :to="{name: 'teams',}"><h2>- Manage Teams</h2></router-link>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "TheNavigation"
    }
</script>

<style scoped>

</style>
