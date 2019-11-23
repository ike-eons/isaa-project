<template>
    <h2>I am in example component</h2>
</template>

<script>
   export default {
    mounted() {
        axios.get("/admins/clearancevalidators").then(response => {
            console.log(response.data);
        });
    }
}
</script>
