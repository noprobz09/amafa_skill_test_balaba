<template>
    <div id="wrapper" class="container clearfix">
        <div class="action">
            <button class="btn btn-md btn-success" v-on:click="add();">Add</button>
        </div>
       
        <table class="table" v-cloak>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            
            <tbody v-if="Object.keys(this.persons).length > 0">
                <tr v-for="person in persons" v-bind:key="person.id">
                    <th scope="row">{{ person.id }}</th>
                    <td>{{ person.lastname }}</td>
                    <td>{{ person.firstname }}</td>
                    <td>{{ person.age }}</td>
                    <td>{{ person.gender }}</td>
                    <td><a href="javascript:void(0);" v-on:click="view(person.id)">View</a> | <a href="javascript:void(0);" v-on:click="remove(person.id)">Delete</a></td>
                </tr>
            </tbody>

            <tbody v-else>
                <tr>
                    <td colspan="5">No Data Found.</td>
                </tr>
            </tbody>

        </table>

        <!-- modal -->
        <div class="modal" id="person-modal">
            <div class="modal-dialog" role="document">
                <form v-on:submit.prevent="submit">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Person</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" v-model="person.firstname" id="firstname" placeholder="First Name">
                                </div>

                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" v-model="person.lastname" id="lastname" placeholder="Last Name">
                                </div>

                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="text" class="form-control" v-model="person.age" id="age" placeholder="Age">
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select id="gender" v-model="person.gender" class="form-control">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                
                                <input type="hidden" v-model="person.id" />
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" >{{ (onUpdate)  ? 'Update' : 'Save' }}</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import { RepositoryFactory } from '../repositories/RepositoryFactory';    
    import PersonFactory from '../repositories/factories/PersonFactory';
    const PersonRepository = RepositoryFactory.get('persons');
    

    export default {

        data() {
            return {
                persons: {},
                person:{},
                onUpdate: false,
            }
        },
       
        methods: {

            closeModal() {
                $('#person-modal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },

            openModal() {
                $('#person-modal').modal('show');
                
            },

            add() {
                this.openModal();
                this.onUpdate = false;
            },

            async fetch() {
                const persons = await PersonRepository.get();
                this.persons = persons.data;
                console.log(this.persons);
            },

            async submit() {
                
                if (this.onUpdate) {
                    this.update();
                } else {
                    const person = await PersonFactory.add(this.person);
                    this.person = {};
                    this.fetch();
                    this.closeModal();
                }
                
            },

            async remove(id) {
                if (confirm('Are you sure you want to delete this record.') ) {
                    const person = await PersonFactory.delete(id);
                    this.fetch();
                }
            },

            async view(id) {
                const person = await PersonRepository.view(id);
                this.person = person.data.data;
                this.openModal();
                this.onUpdate = true;
            },

            async update() {
                const person = await PersonFactory.update(this.person);
                this.person = {};
                this.fetch();
                this.closeModal();
            }
            
        },

        created() {
            this.fetch();
        }
        
    }
</script>
