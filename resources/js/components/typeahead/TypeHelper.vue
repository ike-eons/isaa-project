<template>
  <div>
    <div class="form-control" :tabindex="tabindex"
        @click="onToggle"
        @keydown="onKey"
        ref="toggle"
    >
    <span>{{selectedText}}</span>    
    </div>
    <transition name="fade" mode="out-in">
        <div v-if="isOpen">
            <div class="form-group">
                <input type="text" class="form-control" 
                    autocomplete="off" 
                    placeholder="Search..."
                    ref="search"
                    @blur="onBlur"
                    @input="onSearch"
                    @keydown.esc="onEsc"
                    @keydown.up="onUpKey"
                    @keydown.down="onDownKey"
                    @keydown.enter="onEnterKey"       
                >
                <div>
                    <ul class="typeahead-list" v-if="results.length">
                        <li class="typeahead-item" v-for="(result,index) in results" :key="result.id">
                            <a :class="['typeahead-link', selectIndex === index ? 'typeahead-active':'']"
                                @mousedown.prevent="select(result)"
                                @mouseover.prevent="onMouse(index)"
                                >{{result.text}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
                           
        </div>   
    </transition>
  </div>
</template>

<script>

import { get } from '../../service/api.js'

export default {
    props:{
        url: {
            required: true
        },
        tabindex: {
            default: 0
        },
        initialize:{
            default:null
        }
    },
    data(){
        return{
            isOpen: false,
            selectIndex:-1,
            search:'',
            results:[]
        }
    },
    computed:{
        selectedText() {
            return this.initialize && this.initialize.text
                ? this.initialize.text
                : 'Type or click to select'
        }
    },
    methods:{
        
        onToggle(){
            if(this.isOpen){
                this.isOpen = false;
            }else{
                this.open();
            }
        },
        onBlur(){
            this.close();
        },
        onKey(e){
            const KeyCode = e.KeyCode || e.which
            if(!e.shiftKey && KeyCode !== 9 && !this.isOpen) {
                this.open()
            }
        },
        onUpKey(){
            if(this.selectIndex > 0) {
                this.selectIndex--
            }
        },
        onDownKey(){
             if(this.results.length - 1 > this.selectIndex) {
                this.selectIndex++
            }
        },
        onEnterKey(){
            const found = this.results[this.selectIndex]
                if(found) {
                this.select(found)
            }
        },
        select(result) {
            this.$emit('input', {
                target: {
                    value: result
                }
            })
            this.close()
        },
        onMouse(index) {
                this.selectIndex = index
        },
        onEsc(){
            this.close()
        },
        close() {
            this.results = []
            this.isOpen = false
            this.search = ''
            this.selectIndex = -1
        },
        onSearch(e){
            const q = e.target.value
            this.selectIndex = 0
            this.fetchData(q)
        },
        open() {
            this.fetchData('')
            this.isOpen = true
            this.$nextTick(() => {
                this.$refs.search.focus()
            })
        },
        fetchData(q){
            get(this.url, {q: q})
            .then((res) => {
                this.$set(this.$data, 'results', res.data.results)
                console.log(res.data);
            })
        }


    }
}
</script>

<style lang="scss" scoped>

    .typeahead {
    position: relative;
    display: block;
    background: #fff;
    &-open {
        border-bottom: 0;
        .form-control {
            background: #fff;
            // box-shadow: $box-shadow;
            border: 1px solid rgb(127, 161, 175);
        }
    }
    &-inner {
        position: relative;
    }
    &-selected {
        cursor: pointer;
        user-select: none;
        display: flex!important;
        justify-content: space-between;
        line-height: 15px;
    }
    &-dropdown {
        width: 100%;
        position: absolute;
        z-index: 45;
        padding: 5px;
        background: #fff;
        border-right: 1px solid rgb(127, 161, 175);
        border-left: 1px solid rgb(127, 161, 175);
        // box-shadow: $box-shadow;
    }
    &-input {
        line-height: 13px;
        font-size: 13px;
        background: #fafafa;
        border: none;
        border-radius: 1px;
        // box-shadow: inset 0 1px 1px 0 rgba(0, 0, 0, 0.1);
        padding: 4px 8px;
        width: 100%;
        display: block;
        &:focus {
            outline-style: dotted;
            outline-width: 1px;
            outline-offset: 1px;
        }
    }
    &-input_wrap {
        position: relative;
    }
    &-list {
        display: block;
        margin: 0;
        width:80%;
        background-color: #ccc;
        padding: 0;
    }
    &-item {
        display: block;
        margin-bottom: 1px
    }
    &-link {
        cursor: pointer;
        display: block;
        padding: 2px;
        background: #fff;
    }
    &-active {
        background: #ccc !important;
        color: #fff;
    }
}

</style>

