<?php

namespace App\Factory;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Symfony\Component\HttpFoundation\Response;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Question|Proxy createOne(array $attributes = [])
 * @method static Question[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Question|Proxy find($criteria)
 * @method static Question|Proxy findOrCreate(array $attributes)
 * @method static Question|Proxy first(string $sortedField = 'id')
 * @method static Question|Proxy last(string $sortedField = 'id')
 * @method static Question|Proxy random(array $attributes = [])
 * @method static Question|Proxy randomOrCreate(array $attributes = [])
 * @method static Question[]|Proxy[] all()
 * @method static Question[]|Proxy[] findBy(array $attributes)
 * @method static Question[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Question[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static QuestionRepository|RepositoryProxy repository()
 * @method Question|Proxy create($attributes = [])
 */
final class QuestionFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://github.com/zenstruck/foundry#model-factories)
            'name' => self::faker()->realText(50),
            'slug' => self::faker()->slug(),
            'question' => self::faker()->paragraphs(
                self::faker()->numberBetween(1, 4),
                true
            ),
            'askedAt' => self::faker()->boolean(70) ? self::faker()->dateTimeBetween('-100 days', '-1 minute') : null,
            'votes' => rand(-20, 50),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Questio n $question) {})
        ;
    }

    protected static function getClass(): string
    {
        return Question::class;
    }
}
