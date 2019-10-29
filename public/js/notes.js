function findById(items, id) {
    for (var i in items) {
        if (items[i].id == id) {
            return items[i];
        }
    }

    return null;
}

var vm = new Vue({
    el: '#app',
    data: {
        name: 'Luis',
        notes: [
            {
                title: 'Programe fácil con la versión 6.0 y todas sus novedades',
                category_id: 1,
                editing: false,
            },
            {
                title: 'El mejor framework progresivo para Javascript',
                category_id: 2,
                editing: false,
            },
            {
                title: 'Trabaje con la versión 5 y sus últimas Herramientas',
                category_id: 3,
                editing: false,
            },
            {
                title: 'Regístrate para aprender cosas nuevas',
                category_id: 4,
                editing: false,
            },
            {
                title: 'v-for es una directiva utilizada para iterar una lista',
                category_id: 2,
                editing: false,
            }
        ],
        categories: [
            {
                id: 1,
                name: 'Laravel'
            },
            {
                id: 2,
                name: 'Vue.js'
            },
            {
                id: 3,
                name: 'HTML'
            },
            {
                id: 4,
                name: 'Publicidad'
            }
        ],
        new_note: {title: '', category_id: '', editing: false}
    },
    methods: {
        createNote() {
            this.notes.push(this.new_note);

            this.new_note = {title: '', category_id: '', editing: false};
        },
        editNote(note) {
            note.editing = true;
        },
        updateNote(note) {
            note.editing = false;
        },
        deleteNote(note) {
            var index = this.notes.indexOf(note);
            
            this.notes.splice(index, 1);
        },
        findCategoryName(id) {
            var category = findById(this.categories, id);

            return category != null ? category.name : '';
        }
    }
});
