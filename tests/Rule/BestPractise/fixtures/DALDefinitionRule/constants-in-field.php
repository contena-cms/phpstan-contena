<?php

declare(strict_types=1);

namespace Contena\Tests\Rule\BestPractise\fixtures\DALDefinitionRule;

use Contena\Core\Framework\DataAbstractionLayer\Entity;
use Contena\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Contena\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Contena\Core\Framework\DataAbstractionLayer\Field\IdField;
use Contena\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Contena\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Contena\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Contena\Core\Framework\DataAbstractionLayer\Field\ParentFkField;
use Contena\Core\Framework\DataAbstractionLayer\Field\ReferenceVersionField;
use Contena\Core\Framework\DataAbstractionLayer\Field\StringField;
use Contena\Core\Framework\DataAbstractionLayer\FieldCollection;
use Contena\Core\Framework\DataAbstractionLayer\Field\VersionField;

class FooDefinition extends EntityDefinition
{
    private const FIELD_ID_STORAGE = 'id';
    private const FIELD_ID_PROPERTY = 'id';

    private const FIELD_SOME_STRING_STORAGE = 'some_string';
    private const FIELD_SOME_STRING_PROPERTY = 'someString';

    private const FIELD_SUB_FOO_STORAGE = 'sub_foo_id';
    private const FIELD_SUB_FOO_PROPERTY = 'subFoo';
    private const FIELD_SUB_FOO_REFERENCE = 'id';

    private const FIELD_PARENT_VERSION_ID_STORAGE = 'parent_version_id';

    public function getEntityName(): string
    {
        return 'foo';
    }

    public function getEntityClass(): string
    {
        return FooEntity::class;
    }

    public function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField(self::FIELD_ID_STORAGE, self::FIELD_ID_PROPERTY))->addFlags(new PrimaryKey(), new Required()),
            new VersionField(),

            new StringField(self::FIELD_SOME_STRING_STORAGE, self::FIELD_SOME_STRING_PROPERTY),

            new OneToOneAssociationField(self::FIELD_SUB_FOO_PROPERTY, self::FIELD_SUB_FOO_STORAGE, self::FIELD_SUB_FOO_REFERENCE, self::class),

            new ParentFkField(self::class),
            new ReferenceVersionField(self::class, self::FIELD_PARENT_VERSION_ID_STORAGE),
        ]);
    }
}

class FooEntity extends Entity
{
    use EntityIdTrait;

    public string $someString;

    public FooEntity $subFoo;

    public ?string $parentId = null;
    public ?string $parentVersionId = null;
}
