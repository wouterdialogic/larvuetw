<template>
    <div class="bg-pri-darker rounded-lg shadow p-6 m-4w-full lg:w-3/4 lg:max-w-lg "  @click="divertClick()" >
        <div class="mb-4">
            <h1 class="text-grey font-thin">{{message}}</h1>
            <!-- <h5 class="text-grey font-thin mt-2" ></h5> -->
            <div class="flex mt-4">
                <input class="shadow appearance-none border rounded-sm w-full py-2 px-3 mr-4 text-grey-darker" v-model="newTodo" @keyup.enter="add" placeholder="Add Todo">
                <button class="flex-no-shrink p-2 border-2 rounded-sm text-teal border-teal hover:text-white hover:bg-teal" @click="add" :disabled="newTodo.length === 0">Add</button>
            </div>
        </div>
        <p></p>
        <div class="max-h-screen-1/2 overflow-y-scroll bg-pri-light rounded-sm">
    
            <div class="flex mb-4 items-center mt-2" v-for="(todo, key) in todos" :key="todo.id">
                <input type="checkbox" :checked="todo.finished" class="ml-2 mr-2" @click="updateStatus(todo)">
                
                <p @click="oneClick(todo, key)" v-show="editTodoId != todo.id" class="w-full"  :class="todo.finished ? 'line-through text-green-dark' : 'text-grey-darkest'">{{todo.text}}</p>
<!-- {{todo.id}} - {{key}} -  -->
                <input v-show="editTodoId == todo.id" v-model="editText" class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker" @keyup.enter="updateTodo(todo)" >  <!-- :placeholder="todo.text" -->
    
                <button class="flex-no-shrink p-2 mr-2  border-2 rounded-sm text-red-darker border-red-darker hover:text-white hover:bg-red" @click="remove(todo.id, key)"> X </button>
            </div>

            <div v-show="todos.length === 0">
                <p class="w-full text-center text-grey-dark">There are no todos</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                todos: [],
                newTodo: '',
                editTodo: '',
                
                message: 'Your todo list',
                result: [],
                delay: 700,
                clicks: 0,
                timer: null,
                editTodoId: 2,
                editText: null,
                messages: {
                    wouter: "Wouter is lief!",
                    tandarts: "Goed blijven poetsen!",
                    bus: "VROOM VROOM!",
                    auto: "VROOM VROOM!",
                    mama: "Mama....",
                    papa: "Pama....",
                    Utrecht: "Utrecht is de shit...",
                    Eindhoven: "Utrecht is de shit...",
                    fiets: "I`ve got a bike, you can ride it if you like",
                    kopen: "Spend it like a maaaniaaaac",
                    betalen: "Spend it like a maaaniaaaac",
                    marktplaats: "Spend it like a maaaniaaaac",
                    scriptie: "Neeeeeeeeeeeeeerd!",
                    huis: "Boompje, beestje",
                    vogel: "Tis een buizerd",
                    kist: "Woon je al in de kist?",
                    tiets: "Tiets is lief",
                    dia: "Dia Dia Diiaaaaaa",
                    "den haag": "Utrecht is de shit...",
                },
            }
        },

        //watch: {
        //firstName: function (val) {
        //  this.fullName = val + ' ' + this.lastName
        //},

        methods: {
            createTodo(text) {
                const t = this;
                
                //t.checkForSomethingLovely(text);

                axios.post('/todos', {text: text, finished: false})
                    .then(({data}) => {
                           t.todos.unshift(data);

                           t.message = "Stored, go on!";

                            t.checkForSomethingLovely(text);
                    });
            },            

            checkForSomethingLovely(input) {
                const t = this;
                var found = false;

                input = input.toLowerCase();

                for (const key of Object.keys(t.messages)) {
                    if (found == true) {
                        break;
                    }

                    if (input.includes(key.toLowerCase() )) {
                        t.message = t.messages[key];
                        var found = true;
                   } 
                }
            },

            updateTodo(todo) {
                const t = this;
                
                todo.text = t.editText;

                console.log(todo.text)
                t.updateStatusDatabase(todo)
                t.editTodoId = null
                
            },  

            add() {
              const t = this;

              if(t.newTodo.length > 0) {
                  t.createTodo(t.newTodo);
                  t.newTodo = '';
              }
            },

            getTodos() {
              const t = this;

              axios.get('/todos')
                  .then(({data}) => {
                    t.todos = data;
                    console.log(t.todos)
                  });
            },

            divertClick: function() {
                const t = this;
                console.log(" two")
                if (t.editTodoId == null) {

                    t.editTodoId = null;
                }
            },

            oneClick: function(todo, key){
                console.log(" one")

                const t = this;
                //  if (this.editTodoId != todo.id) {
                //     this.editTodoId = null
                // } else {
                    t.editTodoId = todo.id;
                    t.editText = todo.text;
                // }
                /*
              this.clicks++ 
              if(this.clicks === 1) {
                console.log("click 1")
                var self = this

               
                this.timer = setTimeout(function() {
                  self.result.push(todo.type);
                  console.log("timeout")
                  self.clicks = 0
                }, this.delay);
              } else{
                // this.$set(this, thiss.editTodoId, key)
                //if (this.editTodoId == todo.id) {
                //    this.editTodoId = null
                //} else {
                //    this.editTodoId = todo.id;
                //    this.editText = todo.text;

                //}
                 clearTimeout(this.timer);  
                 console.log("doubleclick")
                 console.log(todo)
                 todo.editable = !todo.editable;
                 this.result.push('dblclick');
                 this.clicks = 0;
              }     */    
            },      

            updateStatus(todo) {
              const t = this;

              todo.finished = !todo.finished;

              t.updateStatusDatabase(todo)
            },

            updateStatusDatabase(todo) {
                const t = this;

                axios.put('/todos/' + todo.id, {todo})
                .then(({data}) => {
                    console.log(data.status)
                    if (data.status == "ok") {
                        t.checkForSomethingLovely(todo.text);
                    } else {
                        t.message = "Couldnt edit item, check console.";
                    }
                });//
            },

            deleteTodo(id, index) {
                const t = this;

                axios.delete('/todos/' + id)
                .then(({data}) => {
                    console.log(data)
                    if (data.status == "deleted") {
                        t.todos.splice(index, 1);
                        t.message = "Goed gedaan! :)";
                    } else {
                        t.message = "Couldnt delete item, check console.";
                    }
                });
            },

            remove(id, index) {
              const t = this;

              //remove from this list
              t.deleteTodo(id, index);
            }
        },
        created() {
          this.getTodos();
        }
    }
</script>