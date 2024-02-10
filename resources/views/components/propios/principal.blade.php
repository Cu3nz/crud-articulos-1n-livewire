<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{$slot}}
    </div>
</div>

@if (session('mensaje'))

<script>
    Swal.fire({
  icon: "success",
  title: "{{session('mensaje')}}",
  showConfirmButton: false,
  timer: 1500
});
</script>
    
@endif