<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Laptops
        for ($i = 1; $i <= 30; $i++) {
            Product::create([
                'name' => 'Laptop ' . $i,
                'slug' => 'laptop-' . $i,
                'details' => [13, 14, 15][array_rand([13, 14, 15])] . 'inch' . [1, 2, 3][array_rand([1, 2, 3])] . ' TB SSD, 32GB RAM',
                'price' => rand(1499.99, 2499.99),
                'description' => 'Lorem ' . $i . 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla erit controversia. Qua tu etiam inprudens utebare non numquam. Si id dicis, vicimus. Duo Reges: constructio interrete. Egone quaeris, inquit, quid sentiam? Equidem, sed audistine modo de Carneade? Primum in nostrane potestate est, quid meminerimus?',
                'img' => 'https://loremflickr.com/g/320/240/laptop',
            ])->categories()->attach(1);
        }

        $product = Product::find(1);
        $product->categories()->attach(2);



        // Desktops
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Desktop ' . $i,
                'slug' => 'desktop-' . $i,
                'details' => [24, 27, 32][array_rand([24, 27, 32])] . 'inch' . [2, 4, 6][array_rand([2, 4, 6])] . ' TB SSD, 32GB RAM',
                'price' => rand(2499.99, 5499.99),
                'description' => 'Lorem ' . $i . 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla erit controversia. Qua tu etiam inprudens utebare non numquam. Si id dicis, vicimus. Duo Reges: constructio interrete. Egone quaeris, inquit, quid sentiam? Equidem, sed audistine modo de Carneade? Primum in nostrane potestate est, quid meminerimus?',
                'img' => 'https://loremflickr.com/g/320/240/desktop',
            ])->categories()->attach(2);
        }
        // Phones
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Phone ' . $i,
                'slug' => 'phone-' . $i,
                'details' => [4, 5, 7][array_rand([4, 5, 7])] . 'inch' . [8, 32, 64][array_rand([2, 4, 6])] . ' GB SSD, 8GB RAM',
                'price' => rand(499.99, 699.99),
                'description' => 'Lorem ' . $i . 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla erit controversia. Qua tu etiam inprudens utebare non numquam. Si id dicis, vicimus. Duo Reges: constructio interrete. Egone quaeris, inquit, quid sentiam? Equidem, sed audistine modo de Carneade? Primum in nostrane potestate est, quid meminerimus?',
                'img' => 'https://loremflickr.com/g/320/240/phone',
            ])->categories()->attach(3);
        }
        // Tablets
        for ($i = 1; $i <= 5; $i++) {
            Product::create([
                'name' => 'Tablet ' . $i,
                'slug' => 'tablet-' . $i,
                'details' => [7, 10, 12][array_rand([7, 10, 12])] . 'inch' . [8, 32, 64][array_rand([2, 4, 6])] . ' GB SSD, 16GB RAM',
                'price' => rand(299.99, 999.99),
                'description' => 'Lorem ' . $i . 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla erit controversia. Qua tu etiam inprudens utebare non numquam. Si id dicis, vicimus. Duo Reges: constructio interrete. Egone quaeris, inquit, quid sentiam? Equidem, sed audistine modo de Carneade? Primum in nostrane potestate est, quid meminerimus?',
                'img' => 'https://loremflickr.com/g/320/240/tablet',
            ])->categories()->attach(4);
        }

        // TVs
        for ($i = 1; $i <= 5; $i++) {
            Product::create([
                'name' => 'TV ' . $i,
                'slug' => 'tv-' . $i,
                'details' => [23, 37, 50][array_rand([23, 37, 50])] . 'inch',
                'price' => rand(299.99, 999.99),
                'description' => 'Lorem ' . $i . 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla erit controversia. Qua tu etiam inprudens utebare non numquam. Si id dicis, vicimus. Duo Reges: constructio interrete. Egone quaeris, inquit, quid sentiam? Equidem, sed audistine modo de Carneade? Primum in nostrane potestate est, quid meminerimus?',
                'img' => 'https://loremflickr.com/g/320/240/tv',
            ])->categories()->attach(5);
        }
        // Cameras
        for ($i = 1; $i <= 5; $i++) {
            Product::create([
                'name' => 'Camera ' . $i,
                'slug' => 'camera-' . $i,
                'details' => [7, 10, 12][array_rand([7, 10, 12])] . 'inch' . [8, 32, 64][array_rand([2, 4, 6])] . ' GB SSD, 16GB RAM',
                'price' => rand(299.99, 999.99),
                'description' => 'Lorem ' . $i . 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla erit controversia. Qua tu etiam inprudens utebare non numquam. Si id dicis, vicimus. Duo Reges: constructio interrete. Egone quaeris, inquit, quid sentiam? Equidem, sed audistine modo de Carneade? Primum in nostrane potestate est, quid meminerimus?',
                'img' => 'https://loremflickr.com/g/320/240/camera',
            ])->categories()->attach(6);
        }

        // Appliances
        for ($i = 1; $i <= 5; $i++) {
            Product::create([
                'name' => 'Appliance ' . $i,
                'slug' => 'appliance-' . $i,
                'details' => [7, 10, 12][array_rand([7, 10, 12])] . 'inch' . [8, 32, 64][array_rand([2, 4, 6])] . ' GB SSD, 16GB RAM',
                'price' => rand(299.99, 999.99),
                'description' => 'Lorem ' . $i . 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla erit controversia. Qua tu etiam inprudens utebare non numquam. Si id dicis, vicimus. Duo Reges: constructio interrete. Egone quaeris, inquit, quid sentiam? Equidem, sed audistine modo de Carneade? Primum in nostrane potestate est, quid meminerimus?',
                'img' => 'https://loremflickr.com/g/320/240/appliance',
            ])->categories()->attach(7);
        }



        Product::create([
            'name' => 'Macbook Pro 2019',
            'slug' => 'macbook-pro-2019',
            'details' => '15 inch, 1TB SSD, 32GB RAM',
            'price' => 3200,
            'img' => 'https://res.cloudinary.com/www-rocketchipwebsolutions-ie/image/upload/t_media_lib_thumb/v1563465916/E-Commerce%20Site/alex-knight-j4uuKnN43_M-unsplash_u4ixos.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ergo hoc quidem apparet, nos ad agendum esse natos. Quid vero? Quis est tam dissimile homini. Sint ista Graecorum; An eiusdem modi? Duo Reges: constructio interrete.',
        ]);

        Product::create([
            'name' => 'Laptop 32',
            'slug' => 'laptop-32',
            'details' => '15 inch, 1TB SSD, 16GB RAM',
            'price' => 2500,
            'img' => 'https://res.cloudinary.com/www-rocketchipwebsolutions-ie/image/upload/t_media_lib_thumb/v1563466021/E-Commerce%20Site/howard-lawrence-b-RSCirJ70NDM-unsplash_srau2g.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egone quaeris, inquit, quid sentiam? Erat enim res aperta. Nihil minus, contraque illa hereditate dives ob eamque rem laetus. Hoc tu nunc in illo probas. Nunc omni virtuti vitium contrario nomine opponitur. Duo Reges: constructio interrete.',
        ]);

        Product::create([
            'name' => 'Laptop 33',
            'slug' => 'laptop-33',
            'details' => '13.5 inch, 500MB SSD, 8GB RAM',
            'price' => 2300,
            'img' => 'https://res.cloudinary.com/www-rocketchipwebsolutions-ie/image/upload/t_media_lib_thumb/v1563466074/E-Commerce%20Site/anete-lusina-zwsHjakE_iI-unsplash_ntto7x.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egone quaeris, inquit, quid sentiam? Erat enim res aperta. Nihil minus, contraque illa hereditate dives ob eamque rem laetus. Hoc tu nunc in illo probas. Nunc omni virtuti vitium contrario nomine opponitur. Duo Reges: constructio interrete.',
        ]);
        Product::create([
            'name' => 'Laptop 34',
            'slug' => 'laptop-34',
            'details' => '13.5 inch, 1TB Rotary, 8GB RAM',
            'price' => 2000,
            'img' => 'https://res.cloudinary.com/www-rocketchipwebsolutions-ie/image/upload/t_media_lib_thumb/v1563466118/E-Commerce%20Site/lukas-blazek-mcSDtbWXUZU-unsplash_xhmhdb.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egone quaeris, inquit, quid sentiam? Erat enim res aperta. Nihil minus, contraque illa hereditate dives ob eamque rem laetus. Hoc tu nunc in illo probas. Nunc omni virtuti vitium contrario nomine opponitur. Duo Reges: constructio interrete.',
        ]);
        Product::create([
            'name' => 'Laptop 35',
            'slug' => 'laptop-35',
            'details' => '13.5 inch, 500MB Rotary, 8GB RAM',
            'price' => 1700,
            'img' => 'https://res.cloudinary.com/www-rocketchipwebsolutions-ie/image/upload/t_media_lib_thumb/v1563466149/E-Commerce%20Site/carlos-muza-hpjSkU2UYSU-unsplash_fva5so.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egone quaeris, inquit, quid sentiam? Erat enim res aperta. Nihil minus, contraque illa hereditate dives ob eamque rem laetus. Hoc tu nunc in illo probas. Nunc omni virtuti vitium contrario nomine opponitur. Duo Reges: constructio interrete.',
        ]);
        Product::create([
            'name' => 'Laptop 36',
            'slug' => 'laptop-36',
            'details' => '9 inch, 250MB SSD, 4GB RAM',
            'price' => 1500,
            'img' => 'https://res.cloudinary.com/www-rocketchipwebsolutions-ie/image/upload/t_media_lib_thumb/v1563466194/E-Commerce%20Site/michal-kubalczyk-WecngmAT-KY-unsplash_uno2xo.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egone quaeris, inquit, quid sentiam? Erat enim res aperta. Nihil minus, contraque illa hereditate dives ob eamque rem laetus. Hoc tu nunc in illo probas. Nunc omni virtuti vitium contrario nomine opponitur. Duo Reges: constructio interrete.',
        ]);
        Product::create([
            'name' => 'Laptop 37',
            'slug' => 'laptop-37',
            'details' => '9 inch, 500MB SSD, 8GB RAM',
            'price' => 2500,
            'img' => 'https://res.cloudinary.com/www-rocketchipwebsolutions-ie/image/upload/t_media_lib_thumb/v1563466235/E-Commerce%20Site/goran-ivos-wJpl8D38Tq8-unsplash_hyqwqf.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egone quaeris, inquit, quid sentiam? Erat enim res aperta. Nihil minus, contraque illa hereditate dives ob eamque rem laetus. Hoc tu nunc in illo probas. Nunc omni virtuti vitium contrario nomine opponitur. Duo Reges: constructio interrete.',
        ]);
        Product::create([
            'name' => 'Laptop 38',
            'slug' => 'laptop-38',
            'details' => '18 inch, 1TB SSD, 32GB RAM',
            'price' => 3700,
            'img' => 'https://res.cloudinary.com/www-rocketchipwebsolutions-ie/image/upload/t_media_lib_thumb/v1563466276/E-Commerce%20Site/james-mckinven-tpuAo8gVs58-unsplash_bzeaia.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egone quaeris, inquit, quid sentiam? Erat enim res aperta. Nihil minus, contraque illa hereditate dives ob eamque rem laetus. Hoc tu nunc in illo probas. Nunc omni virtuti vitium contrario nomine opponitur. Duo Reges: constructio interrete.',
        ]);
        Product::create([
            'name' => 'Laptop 39',
            'slug' => 'laptop-39',
            'details' => '18 inch, 500MB SSD, 16GB RAM',
            'price' => 3400,
            'img' => 'https://res.cloudinary.com/www-rocketchipwebsolutions-ie/image/upload/t_media_lib_thumb/v1563466324/E-Commerce%20Site/content-pixie-62YQFwl7xSQ-unsplash_nuxfak.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egone quaeris, inquit, quid sentiam? Erat enim res aperta. Nihil minus, contraque illa hereditate dives ob eamque rem laetus. Hoc tu nunc in illo probas. Nunc omni virtuti vitium contrario nomine opponitur. Duo Reges: constructio interrete.',
        ]);
    }
}