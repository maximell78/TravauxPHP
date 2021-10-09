<div id="modalMAJ" class="modal" tabindex="-1" role="dialog">
  <form class="needs-validation" novalidate method="POST">
    <div class="modal-dialog mw-100 w-50" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Mise à jour d'un prodit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-4 mb-3">
              <label for="code">Code *</label>
              <!-- Attention! Vos validations doivent être cohérentes avec le champ correspondant dans la BD! -->
              <input type="hidden" id="id_MAJ" name="id" value="<?= $produit["id"] ?>">
              <input type="text" class="form-control" id="code_MAJ" name="code" value="<?= $produit["code"] ?>" required maxlength="25">
              <div class="invalid-feedback">
                Le code est requis et doit comporter moins de 25 caractères. 
              </div>
            </div>
            <div class="col-md-8 mb-3">
              <label for="nom">Nom du produit *</label>
              <!-- Attention! Vos validations doivent être cohérentes avec le champ correspondant dans la BD! -->
              <input type="text" class="form-control" id="produit_MAJ" name="nom" value="<?= $produit["produit"] ?>" required minlength="2" maxlength="25">
              <div class="invalid-feedback">
                Le nom du produit est requis et doit comporter entre 2 et 50 caractères. 
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-4 mb-3">
              <label for="prix_unitaire">Prix unitaire (coûtant) *</label>
              <!-- Attention! Vos validations doivent être cohérentes avec le champ correspondant dans la BD! -->
              <input type="number" step=".01" class="form-control" id="prix_unitaire_MAJ" name="prix_unitaire" value="<?= $produit["prix_unitaire"] ?>" required>
              <div class="invalid-feedback">
                Le prix coûtant est requis et doit être numérique. 
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="prix_vente">Prix de vente *</label>
              <!-- Attention! Vos validations doivent être cohérentes avec le champ correspondant dans la BD! -->
              <input type="number" step=".01" class="form-control" id="prix_vente_MAJ" name="prix_vente" value="<?= $produit["prix_vente"] ?>" required>
              <div class="invalid-feedback">
                Le prix de vente est requis et doit être numérique. 
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="qte_stock">Quantité en stock</label>
              <!-- Attention! Vos validations doivent être cohérentes avec le champ correspondant dans la BD! -->
              <input type="number" class="form-control" id="qte_stock_MAJ" name="qte_stock" value="<?= $produit["qte_stock"] ?>" required>
              <div class="invalid-feedback">
                La quantité en stock est requise et doit être numérique. 
              </div>
            </div>
		      </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" name="majSubmit" type="submit">Mettre à jour le produit</button>  
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        </div>
      </div>
    </div>
  </form>
</div>