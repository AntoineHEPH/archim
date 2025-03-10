
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Importation des disponibilités</h3>
                </div>
                <div class="card-body">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <!-- Sélecteur de date -->
                        <div class="mb-3">
                            <label for="datePicker" class="form-label">Choisir une date</label>
                            <input type="date" class="form-control" id="datePicker" required>
                        </div>
                        <div class="mb-3">
                            <label for="fileInput" class="form-label">Importer un fichier .xlsx</label>
                            <input type="file" class="form-control" id="fileInput" accept=".xlsx" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
