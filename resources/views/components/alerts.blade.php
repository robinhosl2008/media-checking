<div>
    <div id="alertas"></div>
    
    @if(session('msg-alert'))
      <div id="alert" class="alert alert-{{ session('tipo-msg-alert') }}" role="alert">
        <p class="mb-0">
          {{ session('msg-alert') }}
        </p>
      </div>

      <script>
        setTimeout(function(){
          var node = document.getElementById("alert");
          if (node.parentNode) {
            node.parentNode.removeChild(node);
          }
        }, 3000);
      </script>
      @php
        session()->forget('msg-alert');
      @endphp
    @endif

    <script src="{{ asset('js/utils/alerts.js') }}"></script>
</div>