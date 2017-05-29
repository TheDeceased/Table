<?php

include 'vendor/autoload.php';

use TheDeceased\Table\Range;
use TheDeceased\Table\Table;
use TheDeceased\Table\Row;
use TheDeceased\Table\Formatters\BashFormatter;
use TheDeceased\Table\Formatters\HTMLFormatter;
use TheDeceased\Table\Formatters\XLSFormatter;

$format = 'xls';

$table = new Table();
$table->setColumnsWidths([
	'xls' => [
		0 => 8.75,
		1 => 44.805,
		2 => 18.75,
		3 => 18.75,
		4 => 18.75,
	],
	'pdf' => [
		0 => 150,
		2 => 20
	],
]);

$table->setColumnStyle('xls', 0, [
	'align' => [
		'horizontal' => 'center',
	],
]);
$table->setColumnStyle('xls', 1, [
	'align' => [
		'horizontal' => 'left',
	],
]);
$table->setColumnStyle('xls', 2, [
	'align' => [
		'horizontal' => 'right',
	],
]);
$table->setColumnStyle('xls', 3, [
	'align' => [
		'horizontal' => 'right',
	],
]);
$row = Row::createFromArray([
	[
		'value' => 'Обобщенные сведения',
		'colspan' => 8,
		'font' => [
			'bold' => true,
			'italic' => true,
		]
	],
]);
//$row->setHeights([
//	'xls' => 50,
//	'pdf' => 200
//]);
//$row->setStyles('xls', [
//	'background' => 'CECECE',
//	'border' => 'thick',
//]);
$table->addRow($row);
$table->addRow(Row::createFromArray([
	[
		'value' => 'о национальных военных кадрах и техническом персонале иностранных',
		'colspan' => 8,
	],
]));
$table->addRow(Row::createFromArray([
	[
		'value' => 'государств, подготовленных в воинских частях и организациях ВС РФ',
		'colspan' => 8,
	],
]));
$table->addRow(Row::createFromArray([
	[
		'value' => 'по состоянию на 28.04.2017 г.',
		'colspan' => 8,
		'font' => [
			'size' => 10
		]
	],
]));
$table->addRow(Row::createFromArray([
	[
		'value' => 'по состоянию на 28.04.2017 г.',
		'colspan' => 8,
		'align' => [
			'horizontal' => 'left'
		],
	],
]));
$row = Row::createFromArray([
	[
		'value' => '№ п/п',
		'rowspan' => 2,
	],
	[
		'value' => 'Страна',
		'rowspan' => 2,
	],
	[
		'value' => 'Всего по стране',
		'rowspan' => 2,
	],
	[
		'value' => 'В том числе в ВУЗах',
		'colspan' => 5,
	],
]);
$row->setStyles('xls', [
	'background' => 'BFBFBF',
	'font' => [
		'size' => 12,
	],
	'align' => [
		'horizontal' => 'center',
		'vertical' => 'center',
	],
	'border' => 'thin',
]);
$table->addRow($row);
$row = Row::createFromArray([
	[
		'value' => 'Не входящих в виды ВС',
	],
	[
		'value' => 'Сухопутных войск',
	],
	[
		'value' => 'ВВС',
	],
	[
		'value' => 'ВМФ',
	],
	[
		'value' => 'Тыла',
	],
]);
$row->setStyles('xls', [
	'background' => 'BFBFBF',
	'font' => [
		'size' => 12,
	],
	'align' => [
		'horizontal' => 'center',
		'vertical' => 'center',
	],
	'border' => 'thin',
]);
$row->setHeight('xls', 48.75);
$table->addRow($row);

$data = [
	'regions' => [
		[
			'title' => 'Движения',
			'countries' => [
				[
					'title' => 'Ливан',
					'total' => 27,
					'type_1' => 15,
					'type_2' => 6,
					'type_3' => 0,
					'type_4' => 0,
					'type_5' => 0,
				]
			],
			'total' => 27,
			'type_1' => 15,
			'type_2' => 6,
			'type_3' => 0,
			'type_4' => 0,
			'type_5' => 0,
		],
		[
			'title' => 'Страны Азии',
			'countries' => [
				[
					'title' => 'Афганистан',
					'total' => 110,
					'type_1' => 41,
					'type_2' => 34,
					'type_3' => 0,
					'type_4' => 0,
					'type_5' => 35,
				],
				[
					'title' => 'Вьетнам',
					'total' => 1300,
					'type_1' => 55,
					'type_2' => 70,
					'type_3' => 366,
					'type_4' => 794,
					'type_5' => 15,
				],
			],
			'total' => 1410,
			'type_1' => 96,
			'type_2' => 104,
			'type_3' => 366,
			'type_4' => 794,
			'type_5' => 50,
		]
	],
	'total' => 1437,
	'type_1' => 114,
	'type_2' => 110,
	'type_3' => 366,
	'type_4' => 794,
	'type_5' => 50,
];

$num = 1;
foreach ($data['regions'] as $region) {
	$row = Row::createFromArray([
		[
			'value' => $region['title'],
			'colspan' => 8,
			'bold' => true,
		],
	]);
	$row->setStyles('xls', [
		'font' => [
			'bold' => true,
		],
	]);
	$table->addRow($row);
	foreach ($region['countries'] as $country) {
		$table->addRow(Row::createFromArray([
			[
				'value' => $num,
			],
			[
				'value' => $country['title'],
			],
			[
				'value' => $country['total'],
			],
			[
				'value' => $country['type_1'],
			],
			[
				'value' => $country['type_2'],
			],
			[
				'value' => $country['type_3'],
			],
			[
				'value' => $country['type_4'],
			],
			[
				'value' => $country['type_5'],
			],
		]));
		$num++;
	}
	$row = Row::createFromArray([
		[
			'value' => '',
		],
		[
			'value' => 'ИТОГО ПО РЕГИОНУ',
			'bold' => true,
			'italic' => true,
		],
		[
			'value' => $region['total'],
			'bold' => true,
			'italic' => true,
		],
		[
			'value' => $region['type_1'],
			'bold' => true,
			'italic' => true,
		],
		[
			'value' => $region['type_2'],
			'bold' => true,
			'italic' => true,
		],
		[
			'value' => $region['type_3'],
			'bold' => true,
			'italic' => true,
		],
		[
			'value' => $region['type_4'],
			'bold' => true,
			'italic' => true,
		],
		[
			'value' => $region['type_5'],
			'bold' => true,
			'italic' => true,
		],
	]);
	$row->setStyles('xls', [
		'font' => [
			'bold' => true,
		],
	]);
	$table->addRow($row);
}
$table->addRow(Row::createFromArray([
	[
		'value' => '',
		'colspan' => 8
	]
]));
$row = Row::createFromArray([
	[
		'value' => '',
	],
	[
		'value' => 'ВСЕГО',
		'bold' => true,
		'italic' => true,
	],
	[
		'value' => $data['total'],
		'bold' => true,
		'italic' => true,
	],
	[
		'value' => $data['type_1'],
		'bold' => true,
		'italic' => true,
	],
	[
		'value' => $data['type_2'],
		'bold' => true,
		'italic' => true,
	],
	[
		'value' => $data['type_3'],
		'bold' => true,
		'italic' => true,
	],
	[
		'value' => $data['type_4'],
		'bold' => true,
		'italic' => true,
	],
	[
		'value' => $data['type_5'],
		'bold' => true,
		'italic' => true,
	],
]);
$row->setStyles('xls', [
	'font' => [
		'bold' => true,
	],
]);
$table->addRow($row);

$range = new Range([0, 5], [$table->getWidth() - 1, $table->getHeight() - 1]);
$range->setStyles('xls', [
    'border' => 'thin',
]);
$table->addRange($range);

switch ($format) {
	case 'xls':
		echo (new XLSFormatter($table))->output();
		break;
	case 'pdf':
		echo (new PDFFormatter($table))->output();
		break;
	case 'bash':
		echo (new BashFormatter($table, 5))->output();
		break;
	default:
		echo (new HTMLFormatter($table))->output();
}