import Repository from "../Repository";

const resource = "/person";

export default {
    
    add(payload) {
        return Repository.post(`${resource}/add`, payload);
    },

    update(payload) {
        return Repository.patch(`${resource}/update`, payload);
    },

    view(id) {
        return Repository.get(`${resource}/view/${id}`);
    },

    delete(id) {
        return Repository.delete(`${resource}/delete/${id}`);
    },

    get() {
        return Repository.get(`${resource}/lists`);
    },

};