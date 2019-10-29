@extends('layout')

@section('content')
<h2 class="mb-3 mt-3">Listado de notas - @{{ name }}</h2>

<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Categoría</th>
                <th>Titulo</th>
                <th width="65px"></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(note, index) in notes">
                <template v-if="! note.editing">
                    <td scope="row">@{{ index + 1 }}</td>
                    <td>@{{ findCategoryName(note.category_id) }}</td>
                    <td>@{{ note.title }}</td>
                    <td>
                        <a href="#" @click.prevent="editNote(note)"><i class="fas fa-pencil-alt fa-sm fa-fw"></i></a>
                        <a href="#" @click.prevent="deleteNote(note)"><i class="fas fa-trash-alt fa-sm fa-fw"></i></a>
                    </td>
                </template>
                <template v-else>
                    <td scope="row">@{{ index + 1 }}</td>
                    <td>
                        <select class="custom-select" v-model="note.category_id">
                            <option value="">--Categoría--</option>
                            <option v-for="category in categories" :value="category.id">
                                @{{ category.name }}
                            </option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" v-model="note.title">
                    </td>
                    <td>
                        <a href="#" @@click.prevent="updateNote(note)"><i class="fas fa-check fa-sm fa-fw"></i></a>
                        <!-- <a href="#" @@click.prevent="deleteNote(note)"><i class="fas fa-trash-alt fa-sm fa-fw"></i></a> -->
                    </td>
                </template>
            </tr>
            <tr>
                <td scope="row" colspan="2">
                    <select class="custom-select" v-model="new_note.category_id">
                        <option value="">-Categoría-</option>
                        <option v-for="category in categories" :value="category.id">
                            @{{ category.name }}
                        </option>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control" v-model="new_note.title" @keyup.enter="createNote">
                </td>
                <td>
                    <a href="#" @@click.prevent="createNote()"><i class="fas fa-check fa-sm fa-fw"></i></a>
                    <!-- <a href="#" @click.prevent="deleteNote(note)"><i class="fas fa-trash-alt fa-sm fa-fw"></i></a> -->
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Vista data -->
<pre class="code pre-scrollable">@{{ $data }}</pre>
@endsection

@section('scripts')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS (and Vue.js)-->
    <script src="{{ url('js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ url('js/popper.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/vue.js') }}"></script>

    <!-- Main javascript file -->
    <script src="{{ url('js/notes.js') }}"></script>
@endsection
