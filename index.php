<?php
require('require/_bdd.php');
require('require/_html.php');
?>

<body>

    <?php
    require('require/_header.php');
    ?>

    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Sauvegarder changement(s)</button>
                </div>
            </div>
        </div>
    </div>



    <div class="container">
        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h2 class="my-0 fw-normal fs-4">Solde aujourd'hui</h2>
            </div>
            <?php
            $query1 = $dbCo->prepare("SELECT SUM(`amount`) as total FROM `transaction` WHERE `date_transaction` NOT LIKE :date1");
            $query1->execute(['date1' => '2023-08%']);
            $totalAccount = $query1->fetchAll();

            echo '<div class="card-body">';
            echo '<p class="card-title pricing-card-title text-center fs-1">' . intval($totalAccount[0]['total']) . '€ </p>';
            echo '</div>';
            ?>
        </section>

        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h1 class="my-0 fw-normal fs-4">Opérations de Juillet 2023</h1>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">Opération</th>
                            <th scope="col" class="text-end">Montant</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $month = new Datetime();

                        $query2 = $dbCo->prepare("SELECT t.ID_transaction, t.name, t.date_transaction, t.amount, c.icon_class FROM transaction t LEFT JOIN category c ON c.id_category = t.id_category WHERE t.date_transaction LIKE :date ORDER BY  t.date_transaction DESC");
                        $query2->execute(['date' => $month->format('Y-m') . '%']);
                        $detailCurrentMonth = $query2->fetchAll();

                        foreach ($detailCurrentMonth as $arrayKey => $values) {
                            echo '<tr>';
                            echo '<td width="50" class="ps-3"><i class="bi bi-' . $values['icon_class'] . ' fs-3"></i></td>';;
                            echo '<td><time datetime="' . $values['date_transaction'] . '" class="d-block fst-italic fw-light">' . $values['date_transaction'] . '</time>' . $values['name'] . '</td>';
                            echo '<td class="text-end"><span class="rounded-pill text-nowrap bg-warning-subtle px-2">' . $values['amount'] . '€</span></td>';
                            echo '<td class="text-end text-nowrap"><a href="modify.php?ID_transaction='.$values['ID_transaction'].'" class="btn btn-outline-primary btn-sm rounded-circle"><i class="bi bi-pencil"></i></a><a href="#" class="btn btn-outline-danger btn-sm rounded-circle"><i class="bi bi-trash"></i></a></td>';
                            echo '</tr>';
                        }
                        ?>
                        <!-- <tr>
                            <td width="50" class="ps-3">
                            </td>
                            <td>
                                <time datetime="2023-07-10" class="d-block fst-italic fw-light">10/07/2023</time>
                                Bar
                            </td>
                            <td class="text-end">
                                <span class="rounded-pill text-nowrap bg-warning-subtle px-2">
                                    - 32,00 €
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td width="50" class="ps-3">
                                <i class="bi bi-car-front fs-3"></i>
                            </td>
                            <td>
                                <time datetime="2023-07-10" class="d-block fst-italic fw-light">10/07/2023</time>
                                Essence voiture
                            </td>
                            <td class="text-end">
                                <span class="rounded-pill text-nowrap bg-warning-subtle px-2">
                                    - 94,00 €
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td width="50" class="ps-3">
                            </td>
                            <td>
                                <time datetime="2023-07-08" class="d-block fst-italic fw-light">8/07/2023</time>
                                Facture électricité
                            </td>
                            <td class="text-end">
                                <span class="rounded-pill text-nowrap bg-warning-subtle px-2">
                                    - 83,00 €
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td width="50" class="ps-3">
                                <i class="bi bi-house-door fs-3"></i>
                            </td>
                            <td>
                                <time datetime="2023-07-05" class="d-block fst-italic fw-light">5/07/2023</time>
                                Loyer de Juillet 2023
                            </td>
                            <td class="text-end">
                                <span class="rounded-pill text-nowrap bg-warning-subtle px-2">
                                    - 432,00 €
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td width="50" class="ps-3">
                                <i class="bi bi-train-front fs-3"></i>
                            </td>
                            <td>
                                <time datetime="2023-07-02" class="d-block fst-italic fw-light">2/07/2023</time>
                                Billets de train Lille
                            </td>
                            <td class="text-end">
                                <span class="rounded-pill text-nowrap bg-warning-subtle px-2">
                                    - 89,00 €
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td width="50" class="ps-3">
                                <i class="bi bi-bandaid fs-3"></i>
                            </td>
                            <td>
                                <time datetime="2023-07-02" class="d-block fst-italic fw-light">2/07/2023</time>
                                Reboursement sécurité sociale
                            </td>
                            <td class="text-end">
                                <span class="rounded-pill text-nowrap bg-success-subtle px-2">
                                    + 48,00 €
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <nav class="text-center">
                    <ul class="pagination d-flex justify-content-center m-2">
                        <li class="page-item disabled">
                            <span class="page-link">
                                <i class="bi bi-arrow-left"></i>
                            </span>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">Juillet 2023</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="index.php">Juin 2023</a>
                        </li>
                        <li class="page-item">
                            <span class="page-link">...</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="index.php">
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    </div>

    <div class="position-fixed bottom-0 end-0 m-3">
        <a href="add.php" class="btn btn-primary btn-lg rounded-circle">
            <i class="bi bi-plus fs-1"></i>
        </a>
    </div>


    <?php
    require('require/_footer.php');
    ?>