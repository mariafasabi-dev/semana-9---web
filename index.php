<?php
declare(strict_types=1);

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/lib/funciones.php';
require_once __DIR__ . '/lib/casos.php';

/* Guardar datos del alumno (patrón Post/Redirect/Get). */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $turno = (string) ($_POST['turno'] ?? '');
    $_SESSION['alumno'] = [
        'nombre'   => mb_substr(trim((string) ($_POST['nombre'] ?? '')), 0, 80),
        'semestre' => mb_substr(trim((string) ($_POST['semestre'] ?? '')), 0, 20),
        'turno'    => in_array($turno, TURNOS_VALIDOS, true) ? $turno : '',
    ];
    header('Location: index.php?guardado=1');
    exit;
}

$alumno = $_SESSION['alumno'] ?? ['nombre' => '', 'semestre' => '', 'turno' => ''];
$tituloPagina = 'Menú principal';
include_once __DIR__ . '/includes/header.php';
?>

<h1 class="titulo text-center mb-4">MENÚ PRINCIPAL</h1>

<?php foreach (casosPorCategoria() as $categoria => $casos): ?>
    <section class="caja">
        <div class="caja-titulo"><?= h($categoria) ?></div>
        <div class="caja-cuerpo">
            <?php foreach ($casos as $caso): ?>
                <article class="caso">
                    <div class="caso-texto">
                        <h2 class="h5 fw-bold">Caso <?= str_pad((string) $caso['id'], 2, '0', STR_PAD_LEFT) ?>: <?= h($caso['titulo']) ?></h2>
                        <p class="mb-0 text-secondary"><strong>Enunciado:</strong> <?= h($caso['enunciado']) ?></p>
                    </div>
                    <a class="btn btn-azul" href="<?= h(urlCaso($caso['id'])) ?>">Ver caso</a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
<?php endforeach; ?>

<section class="caja">
    <div class="caja-titulo">Datos del alumno</div>
    <div class="caja-cuerpo">
        <?php if (isset($_GET['guardado'])): ?>
            <div class="alert alert-success py-2" role="status">Datos guardados. Aparecen en la parte superior de cada página.</div>
        <?php endif; ?>
        <form method="post" action="index.php" class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="nombre">Apellidos y nombres</label>
                <input type="text" class="form-control" id="nombre" name="nombre" maxlength="80"
                       placeholder="Ej.: Quispe Ramos, Ana" value="<?= h($alumno['nombre']) ?>">
            </div>
            <div class="col-sm-6 col-md-3">
                <label class="form-label" for="semestre">Semestre</label>
                <input type="text" class="form-control" id="semestre" name="semestre" maxlength="20"
                       placeholder="Ej.: III" value="<?= h($alumno['semestre']) ?>">
            </div>
            <div class="col-sm-6 col-md-3">
                <label class="form-label" for="turno">Turno</label>
                <select class="form-select" id="turno" name="turno">
                    <option value="">Selecciona</option>
                    <?php foreach (TURNOS_VALIDOS as $t): ?>
                        <option value="<?= h($t) ?>"<?= $alumno['turno'] === $t ? ' selected' : '' ?>><?= h($t) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-azul">Guardar datos</button>
            </div>
        </form>
    </div>
</section>

<?php include_once __DIR__ . '/includes/footer.php'; ?>
