@extends('adminlte::page')

@section('title', 'Gametic')

@section('content_header')
    <h1>Lista de comentarios</h1>
@stop

@section('content')
    @livewire('admin.questions-index')
    @livewire('admin.answers-index')
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('deleteQuestion', questionId => {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger mr-2"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Estás seguro de eliminar el comentario?",
                text: "Si lo eliminas no se podrá recuperar!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('destroyQuestion', { questionId: questionId });

                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El comentario ha sido eliminado con éxito.",
                        icon: "success"
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                    title: "Cancelado",
                    text: "El comentario no se ha eliminado",
                    icon: "error"
                    });
                }
            });
        })

        Livewire.on('deleteAnswer', answerId => {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger mr-2"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Estás seguro de eliminar el comentario?",
                text: "Si lo eliminas no se podrá recuperar!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('destroyAnswer', { answerId: answerId });

                    swalWithBootstrapButtons.fire({
                        title: "Eliminado!",
                        text: "El comentario ha sido eliminado con éxito.",
                        icon: "success"
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                    title: "Cancelado",
                    text: "El comentario no se ha eliminado",
                    icon: "error"
                    });
                }
            });
        })
    </script>
@stop