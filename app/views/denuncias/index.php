<?php ob_start(); ?>

<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Denuncias Ciudadanas</h1>
    <button id="btn-nueva-denuncia" onclick="openCreateModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Nueva Denuncia
    </button>
</div>

<form method="GET" class="mb-4">
    <div class="flex">
        <input type="text" name="search" placeholder="Buscar por título, ciudadano o ubicación" 
               class="w-full px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
               value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-md">
            Buscar
        </button>
    </div>
</form>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Título
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Ciudadano
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Ubicación
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Estado
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($denuncias as $denuncia): ?>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap"><?php echo htmlspecialchars($denuncia['titulo']); ?></p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap"><?php echo htmlspecialchars($denuncia['ciudadano']); ?></p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap"><?php echo htmlspecialchars($denuncia['ubicacion']); ?></p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                            <span class="relative"><?php echo htmlspecialchars($denuncia['estado']); ?></span>
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                        <button onclick="openEditModal(<?php echo $denuncia['id']; ?>)" class="text-indigo-600 hover:text-indigo-900">Editar</button>
                        <button onclick="deleteDenuncia(<?php echo $denuncia['id']; ?>)" class="text-red-600 hover:text-red-900 ml-4">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="mt-4">
    <nav class="flex justify-center">
        <ul class="flex list-none">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="mx-1">
                    <a href="<?php echo BASE_URL; ?>?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"
                       class="px-3 py-2 rounded-md <?php echo $i == $page ? 'bg-blue-500 text-white' : 'bg-white text-gray-700'; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php $content = ob_get_clean(); ?>
<?php require 'app/views/layout.php'; ?>
