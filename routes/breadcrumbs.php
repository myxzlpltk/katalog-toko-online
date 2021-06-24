<?php

namespace App\Models;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dasbor
Breadcrumbs::for('console.dashboard', function (BreadcrumbTrail $trail) {
	$trail->push('Dasbor', route('console.dashboard'));
});

// Profil Saya
Breadcrumbs::for('console.profile', function (BreadcrumbTrail $trail) {
	$trail->push('Profil Saya', route('console.profile'));
});

// Data Usaha
Breadcrumbs::for('console.businesses.index', function (BreadcrumbTrail $trail) {
	$trail->push('Data Usaha', route('console.businesses.index'));
});
// Data Usaha > Tambah Usaha
Breadcrumbs::for('console.businesses.create', function (BreadcrumbTrail $trail) {
	$trail->parent('console.businesses.index');
	$trail->push('Tambah Usaha', route('console.businesses.create'));
});
// Data Usaha > [Usaha]
Breadcrumbs::for('console.businesses.show', function (BreadcrumbTrail $trail, Business $business) {
	$trail->parent('console.businesses.index');
	$trail->push($business->name, route('console.businesses.show', $business));
});
// Data Usaha > [Usaha] > Edit Usaha
Breadcrumbs::for('console.businesses.edit', function (BreadcrumbTrail $trail, Business $business) {
	$trail->parent('console.businesses.show', $business);
	$trail->push('Edit Usaha', route('console.businesses.edit', $business));
});
// Data Usaha > [Usaha] > Terima Undangan
Breadcrumbs::for('console.businesses.invite', function (BreadcrumbTrail $trail, Business $business) {
	$trail->parent('console.businesses.show', $business);
	$trail->push('Terima Undangan', route('console.businesses.invite', $business));
});

// Data Dosen
Breadcrumbs::for('console.teachers.index', function (BreadcrumbTrail $trail) {
	$trail->push('Data Dosen', route('console.teachers.index'));
});
// Data Dosen > Tambah Data Dosen
Breadcrumbs::for('console.teachers.create', function (BreadcrumbTrail $trail) {
	$trail->parent('console.teachers.index');
	$trail->push('Tambah Data Dosen', route('console.teachers.create'));
});
// Data Dosen > Edit Data Dosen
Breadcrumbs::for('console.teachers.edit', function (BreadcrumbTrail $trail, Teacher $teacher) {
	$trail->parent('console.teachers.index');
	$trail->push('Edit Data Dosen', route('console.teachers.edit', $teacher));
});

// Data Bidang Usaha
Breadcrumbs::for('console.business-fields.index', function (BreadcrumbTrail $trail) {
	$trail->push('Data Bidang Usaha', route('console.business-fields.index'));
});
// Data Bidang Usaha > Tambah Data Bidang Usaha
Breadcrumbs::for('console.business-fields.create', function (BreadcrumbTrail $trail) {
	$trail->parent('console.business-fields.index');
	$trail->push('Tambah Data Bidang Usaha', route('console.business-fields.create'));
});
// Data Bidang Usaha > Edit Data Bidang Usaha
Breadcrumbs::for('console.business-fields.edit', function (BreadcrumbTrail $trail, BusinessField $businessField) {
	$trail->parent('console.business-fields.index');
	$trail->push('Edit Data Bidang Usaha', route('console.business-fields.edit', $businessField));
});

// Data Bidang Usaha > Data Jenis Usaha
Breadcrumbs::for('console.business-fields.business-types.index', function (BreadcrumbTrail $trail, BusinessField $businessField) {
	$trail->parent('console.business-fields.index');
	$trail->push('Data Jenis Usaha', route('console.business-fields.business-types.index', $businessField));
});
// Data Bidang Usaha > Data Jenis Usaha > Tambah Data Jenis Usaha
Breadcrumbs::for('console.business-fields.business-types.create', function (BreadcrumbTrail $trail, BusinessField $businessField) {
	$trail->parent('console.business-fields.business-types.index', $businessField);
	$trail->push('Tambah Data Jenis Usaha', route('console.business-fields.business-types.create', $businessField));
});
// Data Bidang Usaha > Data Jenis Usaha > Edit Data Jenis Usaha
Breadcrumbs::for('console.business-types.edit', function (BreadcrumbTrail $trail, BusinessType $businessType) {
	$trail->parent('console.business-fields.business-types.index', $businessType->businessField);
	$trail->push('Edit Data Jenis Usaha', route('console.business-types.edit', $businessType));
});
