<template>
    <div class="card mb-3">
        <div class="card-header pb-0">
            <a :href="`projects/${project.id}`">
                <h4 class="card-title">{{ project.title }}</h4>
                <span class="text-reagent-gray" v-if="project.client">For <strong>{{ project.client }}</strong></span>
            </a>
        </div>

        <div class="card-body pb-3">
            <div v-if="project.users" class="d-flex mb-2">
                <div v-for="user in project.users" :key="user.id">
                    <a :href="`/users/${user.id}`">
                        <img v-if="user.avatar" :src="user.avatar_url" class="avatar mr-1">
                        <span v-else class="user-placeholder mr-1">{{ user.name }}</span>
                    </a>
                </div>
            </div>
            <div v-if="project.tags" class="d-flex mb-2">
                <div v-for="tag in project.tags" :key="tag.id">
                    <span class="badge badge-primary mr-2">{{ tag.name }}</span>
                </div>
            </div>
        </div>

        <div class="card-footer border-top text-light d-flex justify-content-between">
            <span>{{ project.created_at }} </span>

            <div class="d-flex">
                <a v-if="project.can_edit" :href="`/projects/${project.id}/edit`" class="btn btn-sm btn-white" aria-label="Edit">
                    <i class="fas fa-small fa-edit"></i>
                </a>
                <button v-if="project.can_delete" @click="deleteProject" class="btn btn-sm btn-white" aria-label="Delete">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'project'
    ],
    methods: {
        deleteProject() {
            axios.delete(`/projects/${this.project.id}`).then(() => {
                this.$emit('projectDeleted')
            })
        }
    }
}
</script>