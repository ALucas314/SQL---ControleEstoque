    </div>
  </main>
  <footer class="py-4 small text-center text-muted">
    <div class="container">
      <div>Feito com <span class="text-danger">❤</span> para gerenciar seu estoque de açaí.</div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Ativa toasts automaticamente
    document.querySelectorAll('.toast').forEach(function(el){
      var t = new bootstrap.Toast(el);
      t.show();
    });
    // Modal de confirmação para links com data-confirm
    document.addEventListener('click', function(e){
      const link = e.target.closest('a[data-confirm]');
      if (!link) return;
      const msg = link.getAttribute('data-confirm') || 'Confirmar esta ação?';
      if (!confirm(msg)) {
        e.preventDefault();
      }
    });
  </script>
</body>
</html>


