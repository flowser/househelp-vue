<template>
<div id="logout">

</div>
</template>

<script>

export default {
  data() {
        return {

        };
    },
    mounted() {
        // console.log('loggedout successfully')
        this.$store.dispatch("destroyToken")
            .then(({response}) => {
                    this.$router.push({name:'Home'})
                    toast({
                            type: 'success',
                            title: 'You have been logged out successfully'
                    })
                        this.$Progress.finish()
                })
            .catch(({response}) => {
                this.$Progress.fail()
                toast({
                    type: 'error',
                    title: "something is wrong"
                })
            });
    }
}
</script>
