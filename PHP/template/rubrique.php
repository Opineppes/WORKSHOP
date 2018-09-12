<div class="row align-items-center">
    <div class="col-auto mr-auto">
        <h1>Rubrique</h1>
    </div>
    <div class="col-auto">
        <img src="img/allocampus.png" style="max-width:100px" alt="image_rubrique">
    </div>
</div>
<hr>
<div class="d-flex justify-content-center">
    <button class="btn btn-outline-dark w-75" data-toggle="modal" data-target="#rubrique">Ajouter une annonce</button>
</div>
<div class="modal fade" id="rubrique" tabindex="-1" role="dialog" aria-labelledby="article-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form id="article-form">
            <div class="modal-header">
                <h5 class="modal-title">Créer un article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="article-body">
                <div class="form-group">
                    <label for="titre">Titre</label>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" aria-label="With textarea"></textarea>
                </div>
            </div>
            <div class="modal-footer">
				<button type="submit" class="btn btn-outline-info w-50">Confirmer</button>
			</div>
        </form>
        </div>
    </div>
</div>
<hr>
<div class="card">
    <div class="card-body">
        <h3 class="class-title text-center">Nomnom</h3>
        <hr>
        <p class="card-text">Va manger resto</p>
        <a href="#" class="btn btn-primary">Informations</a>
    </div>
    <div class="card-footer">
         <p class="card-text">Auteur 01/01/2000</p>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <h3 class="class-title text-center">Mc do</h3>
        <hr>
        <p class="card-text">sortie au mcdo</p>
        <a href="#" class="btn btn-primary">Informations</a>
    </div>
    <div class="card-footer">
        <p class="card-text">Auteur 01/01/2000</p>
    </div>
</div>