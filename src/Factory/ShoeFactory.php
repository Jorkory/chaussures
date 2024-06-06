<?php

namespace App\Factory;

use App\Entity\Shoe;
use App\Enum\ShoeCategory;
use App\Repository\ShoeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Shoe>
 *
 * @method        Shoe|Proxy                     create(array|callable $attributes = [])
 * @method static Shoe|Proxy                     createOne(array $attributes = [])
 * @method static Shoe|Proxy                     find(object|array|mixed $criteria)
 * @method static Shoe|Proxy                     findOrCreate(array $attributes)
 * @method static Shoe|Proxy                     first(string $sortedField = 'id')
 * @method static Shoe|Proxy                     last(string $sortedField = 'id')
 * @method static Shoe|Proxy                     random(array $attributes = [])
 * @method static Shoe|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ShoeRepository|RepositoryProxy repository()
 * @method static Shoe[]|Proxy[]                 all()
 * @method static Shoe[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Shoe[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Shoe[]|Proxy[]                 findBy(array $attributes)
 * @method static Shoe[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Shoe[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ShoeFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'category' => self::faker()->randomElement(ShoeCategory::cases()),
            'description' => self::faker()->text(),
            'imageUrl' => $this->getRandomShoeImageUrl(),
            'title' => self::faker()->words(3, true),
        ];
    }

    private function getRandomShoeImageUrl(): string
    {
        $shoesImages = glob('public/images/shoes/*.webp');
        $randomImage = $shoesImages[array_rand($shoesImages)];
        return str_replace('public/images/', '/images/', $randomImage);
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Shoe $shoe): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Shoe::class;
    }
}
