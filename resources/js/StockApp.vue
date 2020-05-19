<template>
    <div class="container">
        <div class="navbar">&nbsp;</div>
        <div class="content">
            <transition name="fade" mode="out-in">
                <keep-alive>
                    
                    <router-view class="page" :key="$route.path"></router-view>
                </keep-alive>
                
            </transition>
        </div>
    </div>
</template>

<script>
export default {
    name:'StockApp',
    components:{
        // NewStock
    }
    
}
</script>

<style lang="scss" scoped>

    .fade-enter-active, .fade-leave-active {
        transition: all .2s ease;
    }

    .fade-enter, .fade-leave-active {
        opacity: 0;
    }


</style>