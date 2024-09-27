<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;

use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Branch>
 */
class BranchResource extends ModelResource
{
    protected string $model = Branch::class;

    protected string $title = 'Branches';

    protected string $column = 'name';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Nomi', 'name')->sortable(),
                HasMany::make("E'lonlar", 'ads', AdResource::class)->onlyLink(),
                Text::make('Yaratilgan Vaqti', 'created_at')->sortable(),
                Text::make('Yangilangan Vaqti', 'updated_at')->sortable(),
            ]),
        ];
    }

    /**
     * @param Branch $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
