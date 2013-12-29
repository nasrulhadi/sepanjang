<?php

/**
 * This is the model class for table "operator".
 *
 * The followings are the available columns in table 'operator':
 * @property integer $opt_id
 * @property string $opt_code
 * @property integer $ktg_id
 * @property string $opt_name
 * @property string $opt_status
 */
class Operator extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'operator';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('opt_code, ktg_id, opt_name', 'required'),
			array('ktg_id', 'numerical', 'integerOnly'=>true),
			array('opt_code', 'length', 'max'=>5),
			array('opt_name', 'length', 'max'=>30),
			array('opt_status', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('opt_id, opt_code, ktg_id, opt_name, opt_status', 'safe', 'on'=>'search'),
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
			'opt_id' => 'Opt',
			'opt_code' => 'Opt Code',
			'ktg_id' => 'Ktg',
			'opt_name' => 'Opt Name',
			'opt_status' => 'Opt Status',
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

		$criteria->compare('opt_id',$this->opt_id);
		$criteria->compare('opt_code',$this->opt_code,true);
		$criteria->compare('ktg_id',$this->ktg_id);
		$criteria->compare('opt_name',$this->opt_name,true);
		$criteria->compare('opt_status',$this->opt_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Operator the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
