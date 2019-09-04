<template>
    <div>
        <div class="row mb-3">
            <div class="btn-group ml-3">
                <button @click="updateFilter('all')" class="btn btn-primary">All</button>
                <button @click="updateFilter('completed')" class="btn btn-primary">Completed</button>
                <button @click="updateFilter('running')" class="btn btn-primary">Running</button>
            </div>
            <div class="d-flex ml-3">
                <select v-if="clients" class="mr-2 form-control" v-model="filters.client">
                    <option value="">Select Client</option>
                    <option v-for="(client, id) in clients"
                            :value="id"
                            :key="id"
                            v-text="client"
                            @change="updateFilter(client.id)">
                    </option>
                </select>

                <select v-if="users" class="form-control" v-model="filters.user">
                    <option value="">Select User</option>
                    <option v-for="(user, id) in users"
                            :value="id"
                            :key="id"
                            v-text="user"
                            @change="updateFilter(user.id)">
                    </option>
                </select>
            </div>
            <a v-if="can_create" href="/projects/create" class="btn btn-primary ml-auto mr-3">
                <i class="fa fa-plus mr-2"></i>
                Add Project
            </a>
        </div>
        <div class="card-columns">
            <projectItem v-for="project in projects"
                         :key="project.id"
                         :project="project"
                         v-on:projectDeleted="getProjects">
            </projectItem>
        </div>
    </div>
</template>

<script>
import ProjectItem from './ProjectItem'

export default {
    props: [
        'clients', 'users', 'can_create'
    ],
    components: {
        ProjectItem
    },
    data() {
        return {
            projects: [],
            filters: {
                type: 'all',
                client: '',
                user: '',
            }
        }
    },
    mounted() {
        this.getProjects()
    },
    watch: {
        filters: {
            handler () {
                this.getProjects()
            },
            deep: true
        }
    },
    methods: {
        getProjects() {
            axios.get('/api-projects', {
                params: this.filters
            }).then(({ data }) => {
                this.projects = data.data
            })
        },
        updateFilter(filterVal) {
            this.filters.type = filterVal
        }
    }
}
</script>