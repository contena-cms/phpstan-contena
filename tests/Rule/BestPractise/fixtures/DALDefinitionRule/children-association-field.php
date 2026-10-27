<?php

declare(strict_types=1);

namespace Contena\Tests\Rule\BestPractise\fixtures\DALDefinitionRule;

use Contena\Core\Framework\DataAbstractionLayer\Entity;
use Contena\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Contena\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Contena\Core\Framework\DataAbstractionLayer\Field\ChildrenAssociationField;
use Contena\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Contena\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Contena\Core\Framework\DataAbstractionLayer\Field\IdField;
use Contena\Core\Framework\DataAbstractionLayer\FieldCollection;

class TreeDefinition extends EntityDefinition
{
    public function getEntityName(): string
    {
        return 'tree';
    }

    public function getEntityClass(): string
    {
        return TreeEntity::class;
    }

    public function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            new ChildrenAssociationField(self::class),
            new ChildrenAssociationField(self::class, 'customChildren'),
        ]);
    }
}

class TreeEntity extends Entity
{
    use EntityIdTrait;
}
