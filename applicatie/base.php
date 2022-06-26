<!-- Deze code maaktde basis van elke pagina aan.
Deze bestaat uit de volgende zaken:
Een head waarin de meta-gerelateerde zaken beschreven staan.
Een top waarin de elementen worden gegenereerd aan de bovenkant van de pagina (gebruikergegevens, zoekbalk, logo)
Het stukje htmlContent dat op elke pagina op een unieke manier wordt gevuld.
De footer van de pagina (met links, adresgegevens en link naar boven). -->



<?= generateHead() ?>

<body>
    <?= generateTop() ?>

    <?= $htmlContent ?>

    <?= generateFooter() ?>
</body>

</html>