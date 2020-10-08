<script>
    function generateSpan(emailAddress) {
        //<span class="nospam-email" data-rec="info" data-domain="fotorex" data-tld="hu"></span>
    }
    function reveal() {
        Array.from(document.querySelectorAll('.nospam-email')).forEach((sp) => {

            let a = sp.getAttribute('data-rec')
                +'@'
                +sp.getAttribute('data-domain')
                +'.'
                +sp.getAttribute('data-tld');
            sp.innerHTML = '<a href="mailto:'+a+'">'+a+'</a>';
        })
    }
    reveal();
</script>