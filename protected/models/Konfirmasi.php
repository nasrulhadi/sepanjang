<?php

/**
 * This is the model class for table "konfirmasi".
 *
 * The followings are the available columns in table 'konfirmasi':
 * @property integer $ord_id
 * @property string $knf_date
 * @property string $knf_buyer
 * @property integer $knf_nominal
 */
class Konfirmasi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'konfirmasi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ord_id, knf_date, knf_buyer, knf_nominal', 'required'),
			array('ord_id, knf_nominal', 'numerical', 'integerOnly'=>true),
			array('knf_buyer', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ord_id, knf_date, knf_buyer, knf_nominal', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ord_id' => 'Ord',
			'knf_date' => 'Knf Date',
			'knf_buyer' => 'Knf Buyer',
			'knf_nominal' => 'Knf Nominal',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ord_id',$this->ord_id);
		$criteria->compare('knf_date',$this->knf_date,true);
		$criteria->compare('knf_buyer',$this->knf_buyer,true);
		$criteria->compare('knf_nominal',$this->knf_nominal);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Konfirmasi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
