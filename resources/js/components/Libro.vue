<template>
    <div>
        <h1 class="text-center"> Administrar Libros </h1>
        <hr>  

        <!-- Button trigger modal -->
        <button @click="modificate=false; openModal();" type="button" class="btn btn-primary my-4">
            Nuevo libro
        </button>

        <!-- Modal -->
        <div class="modal" :class="{toShow: modal}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ modalTitle }}</h5>
                        <button @click="closeModal();" type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <div class="modal-body">
                    <div class="my-4">
                        <label for="autor">Nombre del Autor</label>
                        <input v-model="book.autor" type="text" class="form-control" id="autor" placeholder="Nombre del Autor">
                    </div>
                    <div class="my-4">
                        <label for="titulo">Nombre del titulo</label>
                        <input v-model="book.titulo" type="text" class="form-control" id="titulo" placeholder="Nombre del titulo">
                    </div>
                    <div class="my-4">
                        <label for="edicion">Número de edición</label>
                        <input v-model="book.edicion" type="text" class="form-control" id="edicion" placeholder="Número de edición">
                    </div>
                    <div class="my-4">
                        <label for="datosPublicacion">Datos de publicación</label>
                        <input v-model="book.datosPublicacion" type="text" class="form-control" id="datosPublicacion" placeholder="Datos de publicación">
                    </div>
                    <div class="my-4">
                        <label for="tipoContenido">Tipo de contenido</label>
                        <input v-model="book.tipoContenido" type="text" class="form-control" id="tipoContenido" placeholder="Tipo de contenido">
                    </div>
                    <div class="my-4">
                        <label for="restricciones">Restricciones</label>
                        <input v-model="book.restricciones" type="text" class="form-control" id="restricciones" placeholder="Restricciones">
                    </div>
                    <div class="my-4">
                        <label for="materia">Materia</label>
                        <input v-model="book.materia" type="text" class="form-control" id="materia" placeholder="Materia">
                    </div>
                    <div class="my-4">
                        <label for="proveedor">Proveedor</label>
                        <input v-model="book.proveedor" type="text" class="form-control" id="proveedor" placeholder="Proveedor">
                    </div>
                </div>
                    <div class="modal-footer">
                        <button  @click="closeModal();" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button  @click="save();" type="button" class="btn btn-success">Crear</button>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Autor</th>
                <th scope="col">Titulo</th>
                <th scope="col">Edición</th>
                <th scope="col">Datos de publicación</th>
                <th scope="col">Tipo de contenido</th>
                <th scope="col">Restricciones</th>
                <th scope="col">Materia</th>
                <th scope="col">Proveedor</th>
                <th scope="col" colspan="2" class="text-center">Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="book in books" :key="book.id">
                    <th scope="row">{{ book.id }}</th>
                    <td>{{ book.autor }}</td>
                    <td>{{ book.titulo }}</td>
                    <td>{{ book.edicion }}</td>
                    <td>{{ book.datosPublicacion }}</td>
                    <td>{{ book.tipoContenido }}</td>
                    <td>{{ book.restricciones }}</td>
                    <td>{{ book.materia }}</td>
                    <td>{{ book.proveedor }}</td>
                    <td>
                        <button @click="modificate=true; openModal(book);" class="btn btn-warning"> Editar</button>
                    </td>
                    <td>
                        <button @click="toDelete(book.id)" class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios'


export default {
    data(){
        return {
            book : {
                autor: '',
                titulo: '',
                edicion: '',
                datosPublicacion: '',
                tipoContenido: '',
                restricciones: '',
                materia: '',
                proveedor: '',
            },

            //Guardar
            books: [],
            modalTitle: '',
            modal: 0,
            modificate: true,
            id:0,
        }
    },
    methods: {
        async toList(){
            const response = await axios.get('libros');
            this.books = response.data; 
        },

        async toDelete(id){
            const response = await axios.delete('libros/'+id);
            this.toList();
        },

        async save(){
            if(this.modificate){
                const response = await axios.put('libros/'+this.id, this.book);

            }else{
                const response = await axios.post('libros', this.book);
            }
            this.closeModal();
            this.toList();
        },

        openModal(data={}){
            this.modal = 1;
            if(this.modificate){
                this.id=data.id;
                this.modalTitle = "Modificar Libro"
                this.book.autor = data.autor;
                this.book.titulo = data.titulo;
                this.book.edicion = data.edicion;
                this.book.datosPublicacion = data.datosPublicacion;
                this.book.tipoContenido = data.tipoContenido;
                this.book.restricciones = data.restricciones;
                this.book.materia = data.materia;
                this.book.proveedor = data.proveedor;
            } else {
                this.id=0;
                this.modalTitle = "Crear Libro"
                this.book.autor = "";
                this.book.titulo = "";
                this.book.edicion = "";
                this.book.datosPublicacion = "";
                this.book.tipoContenido = "";
                this.book.restricciones = "";
                this.book.materia = "";
                this.book.proveedor = "";
            } 
        },

        closeModal(){
            this.modal = 0;
        },

       


    },
    created(){
        this.toList();
    }
}
</script>

<style>

.toShow{
    display: list-item;
    opacity: 1;
    background: rgb(41, 32, 88);
}

</style>