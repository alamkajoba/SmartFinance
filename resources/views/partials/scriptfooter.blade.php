<script src="{{asset('js/bundle.js?ver=3.1.2')}}"></script>
<script src="{{asset('js/scripts.js?ver=3.1.2')}}"></script>
<script src="{{asset('js/charts/chart-ecommerce.js?ver=3.1.2')}}"></script>
<script>
    document.querySelector('.dark-switch').addEventListener('click', function(e) {
    e.preventDefault();
    
    // Basculer la classe 'dark-mode' sur le body (ou 'dark' selon votre CSS)
    document.body.classList.toggle('dark-mode');
    
    // Enregistrer le choix dans le localStorage
    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
    } else {
        localStorage.setItem('theme', 'light');
    }
    });

    // Appliquer le thème au chargement de la page pour éviter le flash blanc
    (function() {
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    })();
</script>