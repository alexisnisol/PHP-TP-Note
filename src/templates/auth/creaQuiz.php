<main id="create-art">
        <div>
            <h1>Création d'un quiz</h1>
            <section class="form-section">
            <form method="POST" action="/Create_ART2">

                <label for="nomQ">Nom du quiz</label>
                <input type="text" id="nomQ" name="nomQ">

                <label for="theme">Theme de votre quiz</label>
                <input type="text" id="theme" name="theme">

                <label for="nb">Nombre de Question</label>
                <input type="number" id="nb" name="nb">

                <div id="boutons">
                    <button type="reset" class="bouton-bas">Reinitailiser le formulaire</button>
                    <button type="submit" class="bouton-bas" >Créé le quiz</button>
                </div>

            </form>
        </section>
    </main>
