<div>
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-cotnrol"  id ="nombre" wire:model="nombre">
        <small> {{ $nombre }}</small>
    
    </div>

    <div class="form-group">
        <label for="mensaje">Mensaje</label>
        <input type="text" class="form-cotnrol"  id ="mensaje" wire:model="mensaje" >
        <small> {{ $mensaje }}</small>
    
    </div>

    <button class="btn btn-primary" wire:click="sendMessage" >Enviar Mensaje</button>
        <div class="col-6">
            <!-- Mensajes de alerta -->    
            <div style="position: absolute;"
            class="alert alert-success collapse" 
            role="alert" 
            id="avisoSuccess"       
            
            >Se ha enviado</div>        
        </div>  
    <script>
    
   
    window.livewire.on('mensajeEnviado', function () {
        alert("hola");
        $("#avisoSuccess").fadeIn("slow");                
        setTimeout(function(){ $("#avisoSuccess").fadeOut("slow"); }, 3000);                                
    });
      
    
    </script>
    

</div>
