<?php
 namespace Doctrine\DBAL\Types; use Doctrine\DBAL\Platforms\AbstractPlatform; class DateTimeTzType extends Type { public function getName() { return Type::DATETIMETZ; } public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) { return $platform->getDateTimeTzTypeDeclarationSQL($fieldDeclaration); } public function convertToDatabaseValue($value, AbstractPlatform $platform) { return ($value !== null) ? $value->format($platform->getDateTimeTzFormatString()) : null; } public function convertToPHPValue($value, AbstractPlatform $platform) { if ($value === null || $value instanceof \DateTime) { return $value; } $val = \DateTime::createFromFormat($platform->getDateTimeTzFormatString(), $value); if ( ! $val) { throw ConversionException::conversionFailedFormat($value, $this->getName(), $platform->getDateTimeTzFormatString()); } return $val; } } 